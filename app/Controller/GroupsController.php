<?php

class GroupsController extends AppController {

	public function create_group () {
		if ($this->request->is('post')) {
			if($this->request->data['Info']['text'] != NULL) {
				$this->Group->create(array(
					'name' => $this->request->data['Info']['text'],
					'description' => $this->request->data['Info']['text-area']),
				true);
				$this->Group->save(null, true, array('name', 'description'));
				$id = $this->Group->getLastInsertID();
				$this->join($id);
				$this->Session->setFlash(__("Vous avez créé un groupe"));
				$this->redirect(array('controller' => 'groups', 'action' => 'view', $id));
			}
		}
	}

	public function leave($id) {
		if ($this->request->is('get'))
			throw new MethodNotAllowedException();
		$deleteTarget = $this->Group->GroupsUser->find('first', array(
			'conditions' =>	array(
				'group_id' => $id,
				'user_id' => $this->Auth->user('id')
				)
			));
		$this->Group->GroupsUser->delete($deleteTarget['GroupsUser']['id'], true);
		$this->Session->setFlash(__("Vous avez quitté ce groupe"));
		$this->redirect(array('controller' => 'groups', 'action' => 'view', $id));
	}

	public function join($id) {
		App::uses('CakeEmail', 'Network/Email');
		$this->loadModel('Notification');
		if ($this->request->is('get'))
			throw new MethodNotAllowedException();

		$this->Group->GroupsUser->create(array(
				'group_id' => $id,
				'user_id' => $this->Auth->user('id'),
				), true);
		$this->Group->GroupsUser->save(null, true, array('group_id', 'user_id'));

		// $this->Notification->create(array(
		// 		'from_id' => $this->Auth->user('id'),
		// 		'target_id' => $id,
		// 		'notificationType_id' => 2,
		// 		'content_id' => $this->Friend->getInsertID(),
		// 		), true);
		// $this->Notification->save(null, true, array('from_id', 'target_id', 'notificationType_id', 'content_id'));
		// if (Configure::read('email')) {
		// 		$email = new CakeEmail('default');
		// 		$email->to($from['User']['email']);
		// 		$email->subject($this->Auth->user('firstname') . ' ' . $this->Auth->user('lastname') . ' vous a demandé en ami sur socialkod');
		// 		$email->emailFormat('html');
		// 		$email->template('add_friend');
		// 		$email->viewVars(array('firstname' => $this->Auth->user('firstname'), 'lastname' => $this->Auth->user('lastname')));
		// 		$email->send();
		// 	}
		$this->Session->setFlash(__("Vous avez rejoint ce groupe"));
		$this->redirect(array('controller' => 'groups', 'action' => 'view', $id));
	}

	public function get_groups(){ // Get the Users for the view index
		$groups = $this->Group->find('all', array( //Get the list of Users that match with the search
			'conditions' => array(
				'name LIKE' => '%' . $this->params->query['q'] . '%'
				)
			));
		$this->set('groups', $groups);
		$this->layout = false;
		$this->render('/Elements/get_groups');
	}

	public function view($id) {
		$this->loadModel('Post');
		$this->loadModel('Picture');
		$contents = $this->Group->Content->find('all', array(
			'conditions' => array(
				'Content.targetType_id' => 2,
				'Content.target_id' => $id)
			));
		$group = $this->Group->findById($id);
		$array_posts = array();
		$array_pictures = array();
		foreach ($contents as $content) {
			if ($content['Content']['targetType_id'] == 2 && $content['Content']['contentType_id'] == 1)
				$array_posts[] = $content['Content']['id'];
			else if ($content['Content']['targetType_id'] == 2 && $content['Content']['contentType_id'] == 2) {
				$array_pictures[] = $content['Content']['id'];
			}
		}
		$posts = $this->Post->find('all', array(
			'conditions' => array(
				'id' => $array_posts
				)
			));
		$pictures = $this->Picture->find('all', array(
			'conditions' => array(
				'AND' => array(
					'Picture.id' => $array_pictures,
					'Content.contentType_id' => 2,
					)),
			));
		$this->set('group', $group);
		$this->set('contents', $contents);
		$this->set('posts', $posts);
		$this->set('pictures', $pictures);
	}

	public function getgroup($id) {
		return $this->Group->findById($id);
	}

	public function members($id ) {
		if (!$id || !($group = $this->Group->findById($id)))
			throw new NotFoundException(__('Le groupe spécifié est invalide'));
		
		$members_temp = $this->Group->GroupsUser->find('all', array(
			'conditions' => array(
				'group_id' => $id
				)
			));
		$array_members_id = array();
		foreach ($members_temp as $member_temp) {
			$array_members_id[] = $member_temp['GroupsUser']['user_id'];
		}
		$members = $this->Group->User->find('all', array(
			'conditions' => array(
				'id' => $array_members_id
				)
			));
	    $this->set('group', $group);
	    $this->set('members', $members);

    }

    public function sendPost($id) {
    	$this->loadModel('Post');
    	$this->loadModel('Content');
		if (!$id || !($group = $this->Group->User->findById($id)))
	        throw new NotFoundException(__('Le groupe spécifié est invalide'));
	    
	    $this->set('group', $group);

        if ($this->request->is('post')) {
            $this->Post->create();
        $this->Content->create();

        $d = $this->request->data;
        $d['Post']['content'] = nl2br(htmlspecialchars($d['Post']['content']));
		if ( $this->Post->save($d) ) {
			$d2 = array(
				'Content' => array(
					'contentType_id' => 1,
					'targetType_id' => 2,
					'content_id' => $this->Post->id,
					'from_id' => $this->Session->read('Auth.User.id'),
					'target_id' => $id,
				)
			);
			$this->Content->save($d2);
			$this->Session->setFlash(__('Votre post a bien été publié'));

			}
			return $this->redirect(array('action' => 'view', $id));
		}
    }
}
?>