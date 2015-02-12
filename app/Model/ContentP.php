<?php 

class ContentP extends AppModel {
	public $useTable = 'contents_users';
	public $belongsTo = array(
		'Contents' => array(
			'foreignKey' => 'content_id'),
		'Users' => array(
			'foreignKey' => 'user_id'));
}

?>