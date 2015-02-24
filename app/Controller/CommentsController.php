<?php

class CommentsController extends AppController
{
    var $uses = array('Picture', 'Comment');
	function getComment($content_id, $reload)
	{
		$allCom = $this->Comment->find('all', array(
		    'joins' => array(
		        array(
		            'table' => 'users',
		            'type' => 'INNER',
		            'conditions' => array(
		                'users.id = Comment.from_id'
		            )
		        )
		    ),
		    'conditions' => array(
		        'content_id' => $content_id),
		    'fields' => array('users.firstname','users.lastname', 'Comment.content', 'Comment.created',
		    				  'Comment.from_id', 'Comment.content_id'),
		    'order' => array('Comment.created' => 'ASC')
			));
		foreach ($allCom as $key => $val) {
    		$val['Comment']['created'] = date_diff(
    									 date_create($val['Comment']['created']),
    									 date_create(date("c")));
    		if ($val['Comment']['created']->format('%d') > "0")
    			$val['Comment']['created'] = $val['Comment']['created']->format('%d') . " jour";
			else if ($val['Comment']['created']->format('%h') > "0")
    			$val['Comment']['created'] = $val['Comment']['created']->format('%h') . " heure";
			else if ($val['Comment']['created']->format('%i') > "0")
    			$val['Comment']['created'] = $val['Comment']['created']->format('%i') . " minute";
   			else
   				$val['Comment']['created'] = "quelques seconde";
   			if ($val['Comment']['created'][0] != '1')
   				$val['Comment']['created'] = $val['Comment']['created'] . "s";
   			if (file_exists("/RUSH/img/avatars/".$val['Comment']['from_id'].".jpg") == true)
   				$val['users']['picture'] = "/RUSH/img/avatars/".$val['users']['id'].".png";
   			else
   				$val['users']['picture'] = "/RUSH/img/avatars/default.png";
  			$allCom[$key] = $val;
  		}
  		if ($reload == "true")
	  	{
			$content['Content']['id'] = $content_id;
			$this->set('comment', $allCom);
			$this->set('content', $content);
			$this->layout = false;
			$this->render('/Elements/comment');
		}
		else
			return $allCom;
	}


	function postComment()
	{
			if ($this->request->is('post'))
			{
				$this->Comment->create(array(
					'from_id' => $this->Session->read('Auth.User.id'),
					'content_id' => $this->request->data['Comment']['content_id'],
					'content' => $this->request->data['Comment']['content']
					), true);
					$this->Comment->save(NULL, true);
					return $this->redirect($this->referer);
			}
	}
}
?>