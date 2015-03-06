<?php

class Picture extends AppModel {

	public $displayField = 'id';

	public $hasOne = array(
		"Content" => array(
			"foreignKey" => "content_id",
			'conditions' => 'contentType_id = 2'
			)
		);

	public $belongsTo = array(
		"Album" => array(
			"foreignKey" => "album_id"));
}
?>