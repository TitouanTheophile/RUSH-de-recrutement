<?php

class NewsController extends AppController {

	//public $uses = array("contents", "posts", "images");

	// public $scaffold;

	public function index()
	{
		$data = $this->News->find('all');
		debug($this->News->find('all'));
		$this->set('data', $data);
	}
}	
?>