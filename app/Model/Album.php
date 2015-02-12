<?php

class Album extends AppModel {

	public $displayField = 'title';

	public $hasMany = array(
		"Picture" => array(
			"foreignKey" => "album_id"));

	public $belongsTo = array(
		"Profile" => array(
			"foreignKey" => "id"));

	// public $validate = array(
	// 	'title' => array(
	// 		'required' => true,
	// 		'allowEmpty' => false)
	// 	);
}
?>