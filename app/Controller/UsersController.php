<?php

App::uses('Sanitize', 'Utility');

class UsersController extends AppController {
    public $helpers = array('Html', 'Form');
    var $uses = array('User', 'Content', 'Post', 'Comment', 'Friend', 'Group');

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
    public function getComment($content_id) {
    	return $this->Comment->find('all', array('fields' => array('content', 'from_id')),
				 array('conditions' => array('content_id' => $content_id)));
    }
    public function getPending($pending) {
    	if ( $pending == $this->Auth->user('id') ) {return 1;}
    	else {return 0;}
    }

    public function get_users(){ // Get the Users for the view index
		$users = $this->User->find('all', array( //Get the list of Users that match with the search
			'conditions' => array(
				'firstname LIKE' => '%' . $this->params->query['q'] . '%'
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
	    if (!$id) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }
	    $user = $this->User->findById($id);
	    if (!$user) {
            throw new NotFoundException(__('Le profil spécifié est invalide'));
        }
        $contents = $this->Content->find('all',
        	array('conditions' => array('OR' => array('from_id' => $this->Auth->user('id'), 'target_id' => $this->Auth->user('id'))))
        );
        $this->set('contents', $contents);
        $this->set('posts', $this->Post->find('all'));
        $this->set('user', $user);
    }

    /*** NEWS ***/
    public function news($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Le profil spécifié est invalide'));
        }
        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Le profil spécifié est invalide'));
        }

        $arr = array($this->Auth->user('id'));
        $my_friends = $this->Friend->find('all',
			array( 'fields'  =>	array('id', 'user2_id', 'pending'),
				'conditions' =>	array('user1_id' => $this->Auth->user('id') )));
	    $my_friends += $this->Friend->find('all',
			array( 'fields'  =>	array('id', 'user1_id', 'pending'),
				'conditions' =>	array('user2_id' => $this->Auth->user('id') )));

	    $index = count($my_friends);
		while ( $index ) {
			$my_friend = $my_friends[--$index];
			if ( isset($my_friend['Friend']['user1_id']) && $my_friend['Friend']['pending'] == NULL ) {
				array_push($arr, $my_friend['Friend']['user1_id']);
			}
			if ( isset($my_friend['Friend']['user2_id']) && $my_friend['Friend']['pending'] == NULL ) {
				array_push($arr, $my_friend['Friend']['user2_id']);
			}
		}

        $contents = $this->Content->find('all',
        	array('conditions' => array('OR' => array('from_id' => $arr, 'target_id' => $arr)))
        );

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
			if ( $this->User->save($d) ) {
				$this->Session->setFlash(__('Votre compte a bien été créé, vous pouvez desormais vous connecter'));
				return $this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
            $this->Session->setFlash(__('Impossible de créer votre compte'));
        }
    }

    /*** LOGIN ***/
    public function login() {
    	if ($this->Session->read('Auth.User')) {
    		return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
    	}

		if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
            }
            $this->Session->setFlash(__('Identifiants incorrects'));
        }
    }

    /*** LOGOUT ***/
    public function logout() {
    	$this->Session->setFlash(__('Vous êtes maintenant deconnecté'));
    	return $this->redirect($this->Auth->logout());
    }

    /* Profile Edition Section
	****************************************************************** */

	/*** EDIT INFO ***/
    public function editInfo($id = null) {
	    if (!$id) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }

	    $user = $this->User->findById($id);
	    if (!$user) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }
	    $this->set('user', $user);

	    if ($this->request->is(array('user', 'put'))) {
	        $this->User->id = $id;
	        $d = Sanitize::clean($this->request->data, array('encode' => true, 'remove_html' => true));
	        if ($this->User->save($d)) {
	            $this->Session->setFlash(__('Votre profil a bien été mis à jour'));
	            return $this->redirect(array('action' => 'view', $user['User']['id']));
	        }
	        $this->Session->setFlash(__('Impossible de mettre à jour votre profil'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $user;
	    }
	}

	/*** EDIT DATA ***/
	public function editData($id = null) {
	    if (!$id) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }

	    $user = $this->User->findById($id);
	    if (!$user) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }
	    $this->set('user', $user);

	    if ($this->request->is(array('user', 'put'))) {
	        $this->User->id = $id;
	        if ($this->User->save($this->request->data)) {
	            $this->Session->setFlash(__('Votre profil a bien été mis à jour'));
	            return $this->redirect(array('action' => 'view', $user['User']['id']));
	        }
	        $this->Session->setFlash(__('Impossible de mettre à jour votre profil'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $user;
	    }
	}

	/*** EDIT PHOTO ***/
	public function editPhoto($id = null) {
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
	    		$this->Session->setFlash(__('Votre photo a bien été mise a jour'));
	    		return $this->redirect(array('action' => 'view', $user['User']['id']));
	    	}
	    	else {
	    		$this->Session->setFlash(__('Vous ne pouvez pas envoyer ce type de fichier'));
	    	}
	    }else {
	    	$this->User->id = $id;
	    	$this->request->data = $this->User->read();
	    }
	    if (!$this->request->data) {
	        $this->request->data = $user;
	    }
	}

	/* Post Section
	****************************************************************** */

	/*** SEND POST ***/
	public function sendPost($id = null) {
		if (!$id) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }

	    $user = $this->User->findById($id);
	    if (!$user) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }
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
				return $this->redirect(array('action' => 'view', $user['User']['id']));
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
	    if ($this->Content->delete($id)) {
	    	$postRef = $this->Post->find('all',
	    		array( 'fields'  =>	array('id'),
	    			'conditions' =>	array('id' => $content['Content']['content_id'])
	    		)
	    	);
	    	$this->Post->delete($postRef[0]['Post']['id']);
	        $this->Session->setFlash(__('Le post a été supprimé'));
	    }
	    else {
	        $this->Session->setFlash(__("Le post n'a pas pu être supprimé"));
	    }
	    return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
    }

    /* Friend Section
	****************************************************************** */

	/*** FRIENDS ***/
	public function friends($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Le profil spécifié est invalide'));
		}

	    $user = $this->User->findById($id);
	    if (!$user) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }
	    $this->set('user', $user);
	    $my_friends = $this->Friend->find('all',
			array( 'fields'  =>	array('id', 'user2_id', 'pending'),
				'conditions' =>	array('user1_id' => $user['User']['id'])));
	    $my_friends += $this->Friend->find('all',
			array( 'fields'  =>	array('id', 'user1_id', 'pending'),
				'conditions' =>	array('user2_id' => $user['User']['id'])));
	    $this->set('my_friends', $my_friends);
    }

    /* Account Deletion Section
	****************************************************************** */

	/*** ADMIN DELETE ***/
	public function adminDelete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->User->delete($id, true)) {
	        $this->Session->setFlash(
	            __("Le compte avec l'id numéro %s a été supprimé.", h($id))
	        );
	        return $this->redirect(array('action' => 'index'));
	    }
	}

	/*** DELETE ***/
	public function delete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->User->delete($id, true)) {
	        $this->Session->setFlash(__('Votre compte a bien été supprimé'));
	        return $this->redirect($this->Auth->logout());
	    }
	}

}