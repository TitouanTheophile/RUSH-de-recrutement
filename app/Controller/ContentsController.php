<?php

class ContentsController extends AppController
{
	public $uses = array('User', 'Content');

	public function getContents($id, $reload = "null")
	{
		$user = $this->User->find('first', array(
			'conditions' => array(
				'id' => $id
				),
			'contain' => array(
				'Group'
				)
			)
		);
	    $this->try_arg(empty($user), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
        $array_id = array();
		foreach ($user['Group'] as $group)
			$array_id[] = $group['id'];
		$contents = $this->Content->find('all', array(
			'fields' => array(
				'id', 'created', 'contentType_id',
				),
			'contain' => array(
				'User_from' => array(
					'fields' => array(
						'firstname', 'lastname'
						)
					),
				'User_target' => array(
					'fields' => array(
						'firstname', 'lastname'
						)
					),
				'Group' => array(
					'fields' => array(
						'name'
						)
					),
				'Post' => array(
					'fields' => array(
						'id', 'content'
						)
					),
				'Picture' => array(
					'fields' => array(
						'id', 'description'
						)
					),
				),
			'conditions' => array(
				'OR' => array(
        			array('from_id' => $id, 'targetType_id' => 1),
        			array('target_id' => $id, 'targetType_id' => 1),
        			array('from_id' => $id, 'target_id' => $array_id, 'targetType_id' => 2)
        			)
        		),
       		'order' => array('Content.created' => 'DESC')
       		)
		);
		foreach ($contents as $key => $value)
			{
				if ($value['Post']['content'] == null)
					{
						$value['Post']['content'] =  $value['Picture']['description'];
						unset($value['Picture']['description']);
						$contents[$key] = $value;
					}
			}
		if ($reload == "true")
	  		{
				$this->set('contents', $contents);
				$this->layout = false;
				return $this->render('/Elements/posts');
			}
		return $contents;
	}

	public function getPoints($id)
	{
		$content = $this->Content->find('first', array(
			'conditions' => array(
				'id' => $id
				),
			'contain' => array(
				'Points' => array(
					'conditions' => array(
						'user_id' => $this->Session->read('Auth.User.id')
						)
					),
				'LikeP',
				'ConnardP'
				)
			)
		);
	return $content;
	}

	public function addPoint($id, $pointType)
	{
		$content = $this->Content->find('first', array(
			'contain' => array(
				'Points' => array(
					'fields' => array('id','content_id', 'user_id', 'pointType'),
					'conditions' => array(
						'user_id' => $this->Session->read('Auth.User.id')
						)
					)
				),
			'conditions' => array(
				'id' => $id,
				)
			)
		);
		$content_id = $content['Content']['id'];
		if (!empty($content['Points']))
			$point = $content['Points'][0]['pointType'];
		if (isset($point) && $point != $pointType)
			$this->Content->Points->delete($content['Points'][0]['id']);
		else if (isset($point) && $point == $pointType)
			{
				$this->Content->Points->delete($content['Points'][0]['id']);
				$this->redirect($this->referer());
			}
		$this->Content->Points->create(array(
			'user_id' => $this->Session->read('Auth.User.id'),
			'content_id' => $content_id,
			'pointType' => $pointType));
		$this->Content->Points->save(null, false, array('user_id', 'content_id', 'pointType'));
		$this->redirect($this->referer());
	}

	public function removePoint($id, $pointType)
	{
		$content = $this->Content->find('first', array(
			'contain' => array(
				'Points' => array(
					'fields' => array('id','content_id', 'user_id', 'pointType'),
					'conditions' => array(
						'user_id' => $this->Session->read('Auth.User.id')
						)
					)
				),
			'conditions' => array(
				'id' => $id,
				)
			)
		);
		$content_id = $content['Content']['id'];
		if (!empty($content['Points']))
			$point = $content['Points'][0]['pointType'];
		if ($point && $point == $pointType)
			{
				$this->Content->Points->delete($content['Points'][0]['id']);
				$this->redirect($this->referer());
			}
		else
			$this->redirect($this->referer());
	}

}