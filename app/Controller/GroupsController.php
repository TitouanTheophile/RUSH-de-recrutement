<?php

class GroupsController extends AppController {

	function create_group () {
		if ($this->request->is('post')) {
			if($this->request->data['Info']['text'] != NULL)
			$this->Group->create(array(
				'name' => $this->request->data['Info']['text'],
				'description' => $this->request->data['Info']['text-area']), true);
			if($this->Group->save(NULL, true, array('name'))) {
				}	//$this->render('create_group_err');
		}
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

	function post_comment() {
		
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
		if (!$id || !($user = $this->Group->User->findById($id);))
	        throw new NotFoundException(__('Le groupe spécifié est invalide'));
	    
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

				}
				return $this->redirect(array('action' => 'view', $id));
			}
            $this->Session->setFlash(__('Impossible de publier votre post'));
        }
    }
}
?>