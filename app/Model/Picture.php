<?php

class Picture extends AppModel {

	public $displayField = 'id';

	public $hasOne = array(
		"Content" => array(
			"foreignKey" => "content_id"));

	public $belongsTo = array(
		"Album" => array(
			"foreignKey" => "album_id"));
}
?>