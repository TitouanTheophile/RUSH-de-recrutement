<?php

class UsersController extends AppController {
    public $helpers = array('Html', 'Form');
    var $uses = array('User', 'Content', 'Post', 'Comment');

    public function beforeFilter() {
    	parent::beforeFilter();
    	$this->Auth->allow('login', 'signup');
    }

    public function index() {
        $this->set('users', $this->User->find('all'));
    }

    public function getUser($from_id) {
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
        if (!$id)
            throw new NotFoundException(__('Le profil spécifié est invalide'));
        $user = $this->User->findById($id);
        if (!$user)
            throw new NotFoundException(__('Le profil spécifié est invalide'));
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
				return $this->redirect(array('action' => 'view', $user['User']['id']));
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
	    if ($this->User->delete($id)) {
	        $this->Session->setFlash(
	            __("Le post avec l'id numéro %s a été supprimé.", h($id))
	        );
	        return $this->redirect(array('action' => 'index'));
	    }
	}

    public function login() {
    	if ($this->Session->read('Auth.User')) {
    		return $this->redirect(array('controller' => 'users', 'action' => 'index', $this->Auth->user('id')));
    	}
		if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
            }
            $this->Session->setFlash(__('Identifiants incorrects'));
        }
    }

    public function logout() {
    	$this->Session->setFlash(__('Vous êtes maintenant déconnecté. À bientôt !'));
    	$this->Auth->logout();
    	return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
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
}