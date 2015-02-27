<?php

App::uses('Sanitize', 'Utility');

class UsersController extends AppController {
    public $helpers = array('Html', 'Form');
    var $uses = array('User', 'Content', 'Post', 'Comment', 'Friend', 'Group', 'Notification');

    /*** BEFORE FILTER ***/
    public function beforeFilter() {
    	parent::beforeFilter();
    	$this->Auth->allow('signup', 'login');
    }

    /* Index Admin Section
	****************************************************************** */

	/*** INDEX ***/
    public function index() {
        $this->set('users', $this->User->find('all'));
    }

    /* Get function Section
	****************************************************************** */

    public function getUser($id) {
    	return $this->User->findById($id);
    }
   

    public function get_users(){
		$users = $this->User->find('all', array( //Get the list of Users that match with the search
			'conditions' => array(
				'OR' => array(
					'firstname LIKE' => '%' . $this->params->query['q'] . '%',
					'lastname LIKE' => '%' . $this->params->query['q'] . '%'
					)
				)
			));
		$this->set('users', $users);
		$this->layout = false;
		$this->render('/Elements/get_users');
	}

    /* View / News Section
	****************************************************************** */

	/*** VIEW ***/
    public function view($id = null) {
    	$this->try_arg((!isset($id) || $id <= 0), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
	    $user = $this->User->findById($id);
	    $this->try_arg(empty($user), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
        $array_id = array();
		foreach ($user['Group'] as $group) {
			$array_id[] = $group['id'];
		}
        $contents = $this->Content->find('all',
        	array('conditions' => array(
        		'OR' => array(
        			array('from_id' => $this->Auth->user('id'), 'targetType_id' => 1),
        			array('from_id' => $this->Auth->user('id'), 'target_id' => $array_id, 'targetType_id' => 2)
        			)
        		)
        	));
        $this->Notification->updateAll(
			array(
				'viewed' => 1
				),
			array(
				'from_id' => $id,
				'target_id' => $this->Auth->user('id'),
				'notificationType_id' => 3
				));
        $this->set('contents', $contents);
        $this->set('posts', $this->Post->find('all'));
        $this->set('user', $user);
    }

    /*** NEWS ***/
    public function news($id = null) {
        $this->try_arg((!isset($id) || $id <= 0), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
	    $user = $this->User->findById($id);
	    $this->try_arg(empty($user), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
        $arr = array($this->Auth->user('id'));
        $my_friends = $this->Friend->find('all',
			array( 'fields'  =>	array('id', 'user2_id', 'pending'),
				'conditions' =>	array('user1_id' => $this->Auth->user('id') )));
	    $my_friends += $this->Friend->find('all',
			array( 'fields'  =>	array('id', 'user1_id', 'pending'),
				'conditions' =>	array('user2_id' => $this->Auth->user('id') )));
	    $index = count($my_friends);
		while ($index) {
			$my_friend = $my_friends[--$index];
			if (isset($my_friend['Friend']['user1_id']) && $my_friend['Friend']['pending'] == NULL)
				array_push($arr, $my_friend['Friend']['user1_id']);
			if (isset($my_friend['Friend']['user2_id']) && $my_friend['Friend']['pending'] == NULL)
				array_push($arr, $my_friend['Friend']['user2_id']);
		}
		$array_id = array();
		foreach ($user['Group'] as $group) {
			$array_id[] = $group['id'];
		}
        $contents = $this->Content->find('all',
        	array('conditions' => array(
        		'OR' => array(
        			array('from_id' => $arr, 'targetType_id' => 1),
        			array('target_id' => $array_id, 'targetType_id' => 2)
        			)
        		)
        	));
        $this->set('contents', $contents);
        $this->set('posts', $this->Post->find('all'));
        $this->set('user', $user);
    }

    /* Authentification Section
	****************************************************************** */

	/*** REGISTER ***/
    public function signup() {
    	if ($this->Session->read('Auth.User')) {
    		return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
    	}
        if ($this->request->is('post')) {
            $this->User->create();
        	$d = $this->request->data;
			if ($this->User->save($d)) {
				$this->Session->setFlash(__('Votre compte a bien été créé, bienvenue sur socialkod !'));
				$this->Auth->login();
				$this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
			}
            $this->Session->setFlash(__('Impossible de créer votre compte.'));
        }
    }

    /*** LOGIN ***/
    public function login() {
    	if ($this->Session->read('Auth.User'))
    		return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
		if ($this->request->is('post')) {
            if ($this->Auth->login())
                return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
            $this->Session->setFlash(__('Identifiants incorrects'));
        }
    }

    /*** LOGOUT ***/
    public function logout() {
    	$this->Session->setFlash(__('Vous êtes maintenant déconnecté.'));
    	return $this->redirect($this->Auth->logout());
    }

    /* Profile Edition Section
	****************************************************************** */

	/*** EDIT INFO ***/
    public function editInfo($id = null) {
    	$this->try_arg((!isset($id) || $id <= 0), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
	    $user = $this->User->findById($id);
	    $this->try_arg(empty($user), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
	    if ($id != $this->Session->read('Auth.User.id'))
	    	return ($this->render("forbiden_access"));
	    $this->set('user', $user);
	    if ($this->request->is(array('user', 'put'))) {
	        $this->User->id = $id;
	        $d = $this->request->data;
	        if ($this->User->save($d)) {
	            $this->Session->setFlash(__('Votre profil a bien été mis à jour.'));
	            $this->redirect(array('action' => 'view', $user['User']['id']));
	        }
	        $this->Session->setFlash(__('Impossible de mettre à jour votre profil.'));
	    }
	    if (!$this->request->data)
	        $this->request->data = $user;
	}

	/*** EDIT DATA ***/
/*	public function editData($id = null) {
	    $this->try_arg((!isset($id) || $id <= 0), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
	    $user = $this->User->findById($id);
	    $this->try_arg(empty($user), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
	    $this->set('user', $user);
	    if ($this->request->is(array('user', 'put'))) {
	        $this->User->id = $id;
	        if ($this->User->save($this->request->data)) {
	            $this->Session->setFlash(__('Votre profil a bien été mis à jour.'));
	            $this->redirect(array('action' => 'view', $user['User']['id']));
	        }
	        $this->Session->setFlash(__('Impossible de mettre à jour votre profil.'));
	    }
	    if (!$this->request->data)
	        $this->request->data = $user;
	}
*/
	/*** EDIT PHOTO ***/
	public function editPhoto($id = null) {
		if ($id != $this->Session->read('Auth.User.id'))
	    	return ($this->render("forbiden_access"));
		$user = $this->User->findById($id);
		$this->set('user', $user);
	    if ( !empty($this->request->data) ) {
	    	$this->User->id = $id;
	    	$this->User->save($this->request->data);
	    	$extension = strtolower(pathinfo($this->request->data['User']['avatar_file']['name'], PATHINFO_EXTENSION));
	    	if (!empty($this->request->data['User']['avatar_file']['tmp_name']) &&
	    		in_array($extension, array('jpg'))) {
	    		move_uploaded_file(
	    			$this->request->data['User']['avatar_file']['tmp_name'],
	    			IMAGES . 'avatars' . DS . $id . '.' . $extension
	    		);
	    		$this->Session->setFlash(__('Votre photo a bien été mise à jour.'));
	    		$this->redirect(array('action' => 'view', $user['User']['id']));
	    	}
	    	else
	    		$this->Session->setFlash(__('Vous ne pouvez pas envoyer ce type de fichier.'));
	    }
	    else {
	    	$this->User->id = $id;
	    	$this->request->data = $this->User->read();
	    }
	    if (!$this->request->data)
	        $this->request->data = $user;
	}

	/* Post Section
	****************************************************************** */

	/*** SEND POST ***/
	public function sendPost($id = null) {
		$this->try_arg((!isset($id) || $id <= 0), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
	    $user = $this->User->findById($id);
	    $this->try_arg(empty($user), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
	    $this->set('user', $user);
        if ($this->request->is('post')) {
            $this->Post->create();
            $this->Content->create();
        	$d = $this->request->data;
        	$d['Post']['content'] = nl2br(htmlspecialchars($d['Post']['content']));
			if ( $this->Post->save($d) ) {
				$d2 = array(
					'Content' => array(
						'contentType_id' => 1,
						'targetType_id' => 1,
						'content_id' => $this->Post->id,
						'from_id' => $this->Session->read('Auth.User.id'),
						'target_id' => $id,
					)
				);
				$this->Content->save($d2);
				$this->Session->setFlash(__('Votre post a bien été publié'));
				if ($id != $this->Session->read('Auth.User.id')) {
					// $this->Notification->create(array(
					// 	'from_id' => $this->Auth->user('id'),
					// 	'target_id' => $id,
					// 	'notificationType_id' => 3,
					// 	'content_id' => $this->Friend->getInsertID(),
					// 	), true);
					// $this->Notification->save(null, true, array('from_id', 'target_id', 'notificationType_id', 'content_id'));
					// if (Configure::read('email')) {
					// 	$email = new CakeEmail('default');
					// 	$email->to($from['User']['email']);
					// 	$email->subject($this->Auth->user('firstname') . ' ' . $this->Auth->user('lastname') . ' a publié sur votre mur sur socialkod');
					// 	$email->emailFormat('html');
					// 	$email->template('post');
					// 	$email->viewVars(array('firstname' => $this->Auth->user('firstname'), 'lastname' => $this->Auth->user('lastname')));
					// 	$email->send();
					// }
				}
				$this->redirect(array('action' => 'view', $user['User']['id']));
			}
            $this->Session->setFlash(__('Impossible de publier votre post'));
        }
    }

    /*** DELETE POST ***/
    public function deletePost($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    $content = $this->Content->findById($id);
	    $this->Comment->deleteAll(array(
	    	'content_id' => $id));
	    if ($this->Content->delete($id, true)) {
	    	$postRef = $this->Post->find('all',
	    		array( 'fields'  =>	array('id'),
	    			'conditions' =>	array('id' => $content['Content']['content_id'])
	    		)
	    	);
	    	$this->Post->delete($postRef[0]['Post']['id'], true);
	        $this->Session->setFlash(__('Le post a été supprimé'));
	    }
	    else
	        $this->Session->setFlash(__("Le post n'a pas pu être supprimé"));
	    $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
    }

    /* Friend Section
	****************************************************************** */

	/*** FRIENDS ***/
	public function friends($id) {
		$this->try_arg((!isset($id) || $id <= 0), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
	    $user = $this->User->findById($id);
	    $this->try_arg(empty($user), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
	    $this->set('user', $user);
	    $my_friends  = $this->Friend->find('all', array(
	    	'conditions' => array(
	    		'OR' => array(
	    			'user1_id' => $user['User']['id'],
	    			'user2_id' => $user['User']['id']
	    			)
	    		)
	    	));
	    $this->set('my_friends', $my_friends);
	    $this->Notification->updateAll(
			array(
				'viewed' => 1
				),
			array(
				'target_id' => $this->Auth->user('id'),
				'notificationType_id' => 2
				));
    }

    /* Account Deletion Section
	****************************************************************** */

	/*** ADMIN DELETE ***/
	public function adminDelete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->User->delete($id, true)) {
	        $this->Session->setFlash(__("Le compte avec l'id numéro %s a été supprimé.", h($id))
	        );
	        $this->redirect(array('action' => 'index'));
	    }
	}

	/*** DELETE ***/
	public function delete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    $user = $this->User->findById($id);
	    if ($this->User->save($user, true, array('password'))) {
	        $this->Session->setFlash(__('Votre compte a bien été supprimé.'));
	        $this->redirect($this->Auth->logout());
	    }
	}

}