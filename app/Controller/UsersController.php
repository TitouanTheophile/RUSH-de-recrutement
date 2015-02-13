<?php

class UsersController extends AppController {
    public $helpers = array('Html', 'Form');
    //public $component = array('AddAccount');
    var $uses = array('User', 'Content', 'Post');

    public function index() {
        $this->set('users', $this->User->find('all'));
    }

    public function getFrom($from_id) {
    	return $this->User->findById($from_id);
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

    public function signup() {
        if ($this->request->is('post')) {
            $this->User->create();
        	
        	$d = $this->request->data;
        	if ( !empty($d['User']['password']) ) {
        		$d['User']['password'] = Security::hash($d['User']['password']);
        	}

            if ( $this->User->save($d) ) {
            	$this->Session->setFlash(__('Votre compte a bien été créé'));
                return $this->redirect(array('controller' => 'users', 'action' => 'index'));
            }
            $this->Session->setFlash(__('Impossible de créer votre compte'));
        }
    }

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
	    }else {
	    	$this->User->id = $id;
	    	$this->request->data = $this->User->read();
	    }
	    if (!$this->request->data) {
	        $this->request->data = $user;
	    }
	}

	public function delete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->User->delete($id)) {
	        $this->Session->setFlash(
	            __("Le post avec l'id numéro %s a été supprimé.", h($id))
	        );
	        return $this->redirect(array('action' => 'index'));
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

}