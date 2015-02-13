<?php

class Content extends AppModel {
	public $displayField = 'content_id';

	public $belongsTo = array(
		'Users' => array(
			'foreignKey' => 'id'),
		'Groups' => array(
			'foreignKey' => 'id'));

	// public $hasAndBelongsToMany = array("User");

}
?>