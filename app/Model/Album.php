<?php

class Album extends AppModel {

	public $displayField = 'title';

	public $hasMany = array(
		"Picture" => array(
			"foreignKey" => "album_id"));

	public $belongsTo = array(
		"User" => array(
			"foreignKey" => "id"));
}
?>