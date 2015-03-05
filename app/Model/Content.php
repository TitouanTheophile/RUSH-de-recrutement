<?php

class Content extends AppModel {

	public $belongsTo = array(
		'User_from' => array(
			'className' => 'User',
			'foreignKey' => 'from_id'
			),
		'User_target' => array(
			'className' => 'User',
			'foreignKey' => 'target_id'
			),
		'Group' => array(
			'foreignKey' => 'id'
			),
		'Post' => array(
			'foreignKey' => 'content_id'
			),
		'Picture' => array(
			'foreignKey' => 'content_id'
			),
		);

	public $hasMany = array('ContentP');

}
?>