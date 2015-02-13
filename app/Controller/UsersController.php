<?php

class UsersController extends AppController {
    public $helpers = array('Html', 'Form');
    var $uses = array('User', 'Content', 'Post', 'Comment');

    public function beforeFilter() {
    	parent::beforeFilter();
    	$this->Auth->allow('signup', 'login');
    }

    public function index() {
    	$this->layout = 'default_visitor';
        $this->set('users', $this->User->find('all'));
    }

    public function getFrom($from_id) {
    	return $this->User->findById($from_id);
    }
    public function getTarget($target_id) {
    	return $this->User->findById($target_id);
    }
    public function getComment($content_id) {
    	return $this->Comment->find('all', array('fields' => array('content', 'from_id')),
				 array('conditions' => array('content_id' => $content_id)));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Le profil spécifié est invalide'));
        }
        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Le profil spécifié est invalide'));
        }
        $this->set('contents', $this->Content->find('all'));
        $this->set('posts', $this->Post->find('all'));
        $this->set('user', $user);
    }

    public function news($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Le profil spécifié est invalide'));
        }
        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Le profil spécifié est invalide'));
        }
        $this->set('contents', $this->Content->find('all'));
        $this->set('posts', $this->Post->find('all'));
        $this->set('user', $user);
    }

    /* ---------------------------------------- */

    public function signup() {
    	$this->layout = 'default_visitor';
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

    public function login() {
    	$this->layout = 'default_visitor';
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

    public function logout() {
    	$this->Session->setFlash(__('Vous etes maintenant deconnecte. A bientot !'));
    	return $this->redirect($this->Auth->logout());
    }

    /*public function login() {
    	$this->layout = 'default_visitor';
		if ($this->request->is('post'))
		{
		 	$this->set(array('errInfo' => 'none'));
		 	$this->set(array('error' => 'false'));
			$this->Session->write('id', 0);
			$userInfo = $this->request->data['User'];
			if(($answer = $this->User->find('first', array(
					'fields' => array('id', 'password'),
					'conditions' => array('username' => $userInfo['username'])
					))) == false)
			{
				$this->set(array('error' => 'true'));
				$this->set(array('errInfo' => 'username'));
				$this->render('User');
			}
			else
			{
				$this->Session->setFlash("Vous etes maintenant connecte");
				if ($answer != NULL && 
					$answer['User']['password'] == $userInfo['password'])
				{
					$this->Session->write('id',$answer['User']['id']);	
					$this->set(compact($answer));
					return $this->redirect(array('controller' => 'users', 'action' => 'index'));
				}
				else
				{
					$this->set(array('error' => 'true'));
					$this->set(array('errInfo' => 'password'));
					$this->render('User');
					$this->Session->setFlash("Identifiants incorrects");
					return $this->redirect(array('controller' => 'users', 'action' => 'login'));
				}
			}
		}
	}*/

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

	public function editPhoto($id = null) {
		$user = $this->User->findById($id);
		$this->set('user', $user);
	    if ( !empty($this->request->data) ) {
	    	$this->User->id = $id;
	    	$this->User->save($this->request->data);
	    	$extension = strtolower(pathinfo($this->request->data['User']['avatar_file']['name'], PATHINFO_EXTENSION));
	    	if (
	    		!empty($this->request->data['User']['avatar_file']['tmp_name']) &&
	    		in_array($extension, array('jpg', 'jpeg', 'png'))
	    	){
	    		move_uploaded_file(
	    			$this->request->data['User']['avatar_file']['tmp_name'],
	    			IMAGES . 'avatars' . DS . $id . '.' . $extension
	    		);
	    		$this->User->saveField('avatar', $extension);
	    	}
	    	$this->Picture->create();
            $this->Content->create();
	    }else {
	    	$this->User->id = $id;
	    	$this->request->data = $this->User->read();
	    }
	    if (!$this->request->data) {
	        $this->request->data = $user;
	    }
	}

	public function sendPost($id = null) {
		$last = $this->referer;
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
			if ( $this->Post->save($d) ) {
				$d2 = array(
					'Content' => array(
						'contentType_id' => 1,
						'targetType_id' => 1,
						'content_id' => $this->Post->id,
						'from_id' => $this->Session->read('Auth.User.id'),
						'target_id' => $id,
						'points_like' => 0,
						'points_connard' => 0
					)
				);
				$this->Content->save($d2);
				$this->Session->setFlash(__('Votre post a bien été publié'));
				return $this->redirect($last);
			}
            $this->Session->setFlash(__('Impossible de publier votre post'));
        }
    }

    public function friends($id = null) {
    	if (!$id) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }

	    $user = $this->User->findById($id);
	    if (!$user) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }
	    $this->set('user', $user);
    }

	public function adminDelete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->User->delete($id, true)) {
	        $this->Session->setFlash(
	            __("Le post avec l'id numéro %s a été supprimé.", h($id))
	        );
	        return $this->redirect(array('action' => 'index'));
	    }
	}

	public function delete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->User->delete($id, true)) {
	        $this->Session->setFlash(__('Vous etes maintenant deconnecte. A bientot !'));
	        return $this->redirect($this->Auth->logout());
	    }
	}

}