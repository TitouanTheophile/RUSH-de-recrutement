<?php

class ContentsController extends AppController
{
	function getContents($id, $reload = "null")
	{
		$user = $this->requestAction('users/getUser/'. $id);
	    $this->try_arg(empty($user), 'Le profil spécifié est invalide.',
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
        $array_id = array();
		foreach ($user['Group'] as $group)
			$array_id[] = $group['id'];
		$contents = $this->Content->find('all',
			array('fields'=> array('Content.id, Content.created,
				post.content,
				picture.description, picture.id,
				target.id, target.firstname, target.lastname,
				from_usr.id, from_usr.firstname, from_usr.lastname'),
				'joins' => array(
		            array(
		            'table' => 'users AS from_usr',
		            'type' => 'LEFT',
		            'conditions' => array(
		                'from_usr.id = Content.from_id'
		            )),
		            array(
		            'table' => 'users AS target',
		            'type' => 'LEFT',
		            'conditions' => array(
		                'target.id = Content.target_id',
		                'Content.targetType_id = 1'
		            )),
		            array(
		            'table' => 'posts AS post',
		            'type' => 'LEFT',
		            'conditions' => array(
		                'post.id = Content.content_id',
		                'contentType_id = 1'
		            )),
					array(
		            'table' => 'pictures as picture',
		            'type' => 'LEFT',
		            'conditions' => array(
		                'picture.id = Content.content_id',
		                'contentType_id = 2'
		            ))
		            ),
				'conditions' => array('OR' => array(
        			array('from_id' => $id, 'targetType_id' => 1),
        			array('target_id' => $id, 'targetType_id' => 1),
        			array('from_id' => $id, 'target_id' => $array_id, 'targetType_id' => 2)
        			)
        		),
       		'order' => array('Content.created' => 'DESC')
			)
		);
		$content["toto"] = $id;
		foreach ($contents as $key => $value)
		{
			if ($value['post']['content'] == null)
			{
				$value['post']['content'] =  $value['picture']['description'];
				unset($value['picture']['description']);
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

}