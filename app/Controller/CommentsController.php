<?php
class CommentsController extends AppController
{

	function comment($content_id)
	{
		$allCom = $this->Comment->find('all', array('conditions' => array('content_id' => $content_id)));
		$name = array();
		foreach ($allCom as $key => $value) {
			$name[$key] = $this->Comment->find('first', array('field' =>
				array('firstname', 'lastname')), 
			'condition' => array($value['Comment']['from_id'];
		}
		$this->set(array('comment' => $allCom));
		$this->layout = false;
		if ($this->request->is('post'))
		{
			$this->Comment->create(array(
				'from_id' => $this->Session->read('id'),
				'content_id' => $content_id,
				'content' => $this->request->data['post']['text-area']
				), true);
			if ($this->Comment->save(NULL, true))
			{
				$allCom = $this->Comment->find('all',
					array('conditions' => array('content_id' => $content_id)));
				$this->set(array('comment' => $allCom));
			}
		}
		$this->render('comment');
	}
}
?>