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
}
?>