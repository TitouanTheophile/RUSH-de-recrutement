<?php

class GroupsController extends AppController {

	public function create_group () {
        if ($this->request->is('post')) {
            $this->Group->create();
        	$data = $this->request->data;
        	$data['Group']['owner_id'] = $this->Session->read('Auth.User.id');
			if ($this->Group->save($data)) {
				$id = $this->Group->getLastInsertID();
				$this->join($id);
			}
            $this->Session->setFlash(__('Impossible de créer le groupe'));
        }
	}

	public function edit ($id) {
		$group = $this->Group->find('first', array(
			'conditions' =>	array(
				'Group.id' => $id,
				),
			'fields' => array(
				'Group.name',
				'Group.description'
				)
			)
		);
		if ($this->request->is('post')) {
			if($this->request->data['Info']['name'] != NULL || $this->request->data['Info']['description'] != NULL) {
				$name = (strlen($this->request->data['Info']['name']) > 0 ? $this->request->data['Info']['name'] : $group['Group']['name']);
				$desc = (strlen($this->request->data['Info']['description']) > 0 ? $this->request->data['Info']['description'] : $group['Group']['description']);
				$this->Group->updateAll(
					array('Group.name' => "'$name'", 'Group.description' => "'$desc'"),
					array('Group.id' => $id)
					);
				$this->Session->setFlash(__("Vous avez edité le groupe"));
				$this->redirect(array('controller' => 'groups', 'action' => 'view', $id));
			}
			else {
				$this->Session->setFlash(__("Vous n'avez pas edité le groupe"));
				$this->redirect(array('controller' => 'groups', 'action' => 'view', $id));
			}
		}
		$this->set('id', $id);
		$this->set('group', $group);
	}

	public function leave($id) {
		$deleteTarget = $this->Group->GroupsUser->find('first', array(
			'conditions' =>	array(
				'group_id' => $id,
				'user_id' => $this->Auth->user('id')
				)
			));
		$this->Group->GroupsUser->delete($deleteTarget['GroupsUser']['id'], true);
		$members_left = $this->Group->GroupsUser->find('count', array(
			'conditions' =>	array(
				'group_id' => $id,
				)
			));
		if ($members_left != 0) {
			$this->Session->setFlash(__("Vous avez quitté ce groupe"));
			$this->redirect(array('controller' => 'groups', 'action' => 'view', $id));
		}
		else {
			$group = $this->Group->findById($id);
			$this->Group->delete($id, true);
			$this->Session->setFlash(__("Vous avez supprimé le groupe " . $group['Group']['name']));
			$this->redirect(array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
		}
	}

	public function join($id) {
		App::uses('CakeEmail', 'Network/Email');
		$this->loadModel('Notification');

		$group = $this->Group->findById($id);
		$this->Group->GroupsUser->create(array(
				'group_id' => $id,
				'user_id' => $this->Auth->user('id'),
				'role' => ($this->Auth->user('id') == $group['Owner']['id'] ? 1 : 0)
				), true);
		$this->Group->GroupsUser->save(null, true, array('group_id', 'user_id', 'role'));
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

	public function view($id = NULL)
	{
		if (!($this->Group->findById($id)))
	        throw new NotFoundException(__('Le groupe spécifié est invalide'));

		$this->loadModel('Content');
		$this->loadModel('Post');
		$this->loadModel('Picture');

		$group = $this->Group->find('first', array(
			'conditions' => array(
				'Group.id' => $id
				),
			'fields' => array(
				'Group.id',
				'Group.name',
				'Group.description',
				'Group.created'
				)
			)
		);
		$this->set($group);

		$members = $this->Group->GroupsUser->find('all', array(
			'conditions' => array(
				'GroupsUser.group_id' => $id
				),
			'fields' => array(
				'GroupsUser.user_id'
				)
			)
		);
		$this->set('members', $members);

		$contents = $this->Content->find('all', array(
			'contain' => array(
				'User_from',
				'Post'
				),
			'conditions' => array(
				'Content.targetType_id' => 2,
				'Content.target_id' => $id
				),
			'fields' => array(
				'Content.id',
				'Content.contentType_id',
				'Content.created',
				'User_from.id',
				'User_from.lastname',
				'User_from.firstname',
				'Post.content'
				)
			)
		);
		$this->set('contents', $contents);
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

    public function sendPost($id)
    {
    	if (!($this->Group->findById($id)))
	        throw new NotFoundException(__('Le groupe spécifié est invalide'));

    	$this->loadModel('Post');
    	$this->loadModel('Content');
	    

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