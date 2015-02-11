<?php
class CommentsController extends AppController
{
	function comment($content_id)
	{
		$this->Session->write('id', 2);
		$this->layout = false;
		if ($this->request->is('post'))
		{
			$this->Comment->create(array(
				'from_id' => $this->Session->read('id'),
				'content_id' => $content_id,
				'content' => $this->request->data['post']['text-area']
				), true);
			if($this->Comment->save(NULL, true))
				{
					debug("COOOL");
				}
		}
	}
}
?>