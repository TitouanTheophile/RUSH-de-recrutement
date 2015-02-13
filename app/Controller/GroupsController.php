<?php

class GroupsController extends AppController {

<<<<<<< HEAD
	function create_group ()
=======
	function create_groupe()
>>>>>>> f57e5dbcd211c4b66236fdc00f79a6a5be6b9fb5
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