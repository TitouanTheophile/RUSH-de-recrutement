<?php
class CommentsController extends AppController
{

	function getComment($content_id)
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
		        'content_id' => $content_id
		    ),
		    'fields' => array('users.firstname','users.lastname', 'Comment.content', 'Comment.created', 'Comment.from_id', 'Comment.content_id'
		    ),
		    'order' => array('Comment.created' => 'ASC')
			));

		$content['Content']['id'] = $content_id;
		$this->set('comment', $allCom);
		$this->set('content', $content);
		$this->layout = false;
		$this->render('/Elements/comment');
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
			}
	}
}
?>