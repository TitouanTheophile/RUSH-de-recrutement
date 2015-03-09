<?php 

class ContentP extends AppModel {
	public $useTable = 'contents_users';
	
	public $belongsTo = array(
		'Content' => array(
			'foreignKey' => 'content_id'),
		'User' => array(
			'foreignKey' => 'user_id'));
}

?>