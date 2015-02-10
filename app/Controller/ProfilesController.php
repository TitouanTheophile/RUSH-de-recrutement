<?php

class ProfilesController extends AppController {
    public $helpers = array('Html', 'Form');
    //public $component = array('AddAccount');
    var $uses = array('Profile', 'Content', 'Post');

    public function index() {
        $this->set('profiles', $this->Profile->find('all'));
    }

    public function getFrom($from_id) {
    	return $this->Profile->findById($from_id);
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Le profil spécifié est invalide'));
        }
        $profile = $this->Profile->findById($id);
        if (!$profile) {
            throw new NotFoundException(__('Le profil spécifié est invalide'));
        }
        $this->set('contents', $this->Content->find('all'));
        $this->set('posts', $this->Post->find('all'));
        $this->set('profile', $profile);
    }

    public function news($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Le profil spécifié est invalide'));
        }
        $profile = $this->Profile->findById($id);
        if (!$profile) {
            throw new NotFoundException(__('Le profil spécifié est invalide'));
        }
        $this->set('contents', $this->Content->find('all'));
        $this->set('posts', $this->Post->find('all'));
        $this->set('profile', $profile);
    }

    public function signup() {
        if ($this->request->is('post')) {
            $this->Profile->create();
        	
        	$d = $this->request->data;
        	if ( !empty($d['Profile']['password']) ) {
        		$d['Profile']['password'] = Security::hash($d['Profile']['password']);
        	}

            if ( $this->Profile->save($d) ) {
            	$this->Session->setFlash(__('Votre compte a bien été créé'));
                return $this->redirect(array('controller' => 'profiles', 'action' => 'index'));
            }
            $this->Session->setFlash(__('Impossible de créer votre compte'));
        }
    }

    public function editInfo($id = null) {
	    if (!$id) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }

	    $profile = $this->Profile->findById($id);
	    if (!$profile) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }
	    $this->set('profile', $profile);

	    if ($this->request->is(array('profile', 'put'))) {
	        $this->Profile->id = $id;
	        if ($this->Profile->save($this->request->data)) {
	            $this->Session->setFlash(__('Votre profil a bien été mis à jour'));
	            return $this->redirect(array('action' => 'view', $profile['Profile']['id']));
	        }
	        $this->Session->setFlash(__('Impossible de mettre à jour votre profil'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $profile;
	    }
	}

	public function editData($id = null) {
	    if (!$id) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }

	    $profile = $this->Profile->findById($id);
	    if (!$profile) {
	        throw new NotFoundException(__('Le profil spécifié est invalide'));
	    }
	    $this->set('profile', $profile);

	    if ($this->request->is(array('profile', 'put'))) {
	        $this->Profile->id = $id;
	        if ($this->Profile->save($this->request->data)) {
	            $this->Session->setFlash(__('Votre profil a bien été mis à jour'));
	            return $this->redirect(array('action' => 'view', $profile['Profile']['id']));
	        }
	        $this->Session->setFlash(__('Impossible de mettre à jour votre profil'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $profile;
	    }
	}

	public function editPhoto($id = null) {
		$profile = $this->Profile->findById($id);
		$this->set('profile', $profile);
	    if ( !empty($this->request->data) ) {
	    	$this->Profile->id = $id;
	    	$this->Profile->save($this->request->data);
	    	$extension = strtolower(pathinfo($this->request->data['Profile']['avatar_file']['name'], PATHINFO_EXTENSION));
	    	if (
	    		!empty($this->request->data['Profile']['avatar_file']['tmp_name']) &&
	    		in_array($extension, array('jpg', 'jpeg', 'png'))
	    	){
	    		move_uploaded_file(
	    			$this->request->data['Profile']['avatar_file']['tmp_name'],
	    			IMAGES . 'avatars' . DS . $id . '.' . $extension
	    		);
	    		$this->Profile->saveField('avatar', $extension);
	    	}
	    }else {
	    	$this->Profile->id = $id;
	    	$this->request->data = $this->Profile->read();
	    }
	    if (!$this->request->data) {
	        $this->request->data = $profile;
	    }
	}

	public function delete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Profile->delete($id)) {
	        $this->Session->setFlash(
	            __("Le post avec l'id numéro %s a été supprimé.", h($id))
	        );
	        return $this->redirect(array('action' => 'index'));
	    }
	}

	function login () {

		if ($this->request->is('post'))
		 {
		 	$this->set(array('errInfo' => 'none'));
		 	$this->set(array('error' => 'false'));
			$this->Session->write('id', 0);
			$userInfo = $this->request->data['Login'];
			if(($answer = $this->Profile->find('first', array(
					'fields' => array('id', 'password'),
					'conditions' => array('email' => $userInfo['email'])
					))) == false)
			{
				$this->set(array('error' => 'true'));
				$this->set(array('errInfo' => 'email'));
				$this->render('Login');
			}
			else
			{
				if ($answer != NULL && 
					$answer['Profile']['password'] == $userInfo['password'])
				{
					$this->Session->write('id',$answer['Profile']['id']);	
					$this->set(compact($answer));
					//return $this->redirect(array('controller' => 'Notifications', 'action' => 'hello'));
				}
				else
				{
					$this->set(array('error' => 'true'));
					$this->set(array('errInfo' => 'password'));
					$this->render('Login');
				}
			}
		}
}
}