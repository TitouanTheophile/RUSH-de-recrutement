<?php

class GroupsController extends AppController {

	function create_group ()

	{

		if ($this->request->is('post'))
		{
			if($this->request->data['Info']['text'] != NULL)
			$this->Group->create(array(
							'name' => $this->request->data['Info']['text'],
							'description' => $this->request->data['Info']['text-area']), true);
			if($this->Group->save(NULL, true, array('name')))
				{
				
				}	//$this->render('create_group_err');
		}

}

	function post_comment()
	{

		
	}
}
?>