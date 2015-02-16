<?php
class CommentsController extends AppController
{

	function comment($content_id)
	{
		if ($this->request->is('post'))
		{
			$this->Comment->create(array(
				'from_id' => $this->Session->read('id'),
				'content_id' => $content_id,
				'content' => $this->request->data['post']['text-area']
				), true);
				$this->Comment->save(NULL, true);
		}
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
		    'fields' => array('users.firstname','users.lastname', 'Comment.content', 'Comment.created', 'Comment.from_id')
			));
		$this->layout = false;
		$view = new View($this, false);
		$content = $view->element('comment', $allCom);
//		$this->view = $content;
		// $this->set(array('comment' => $allCom));

	}
}
?>