<?php

class Content extends AppModel {
	public $displayField = 'content_id';

	public $hasMany = array('ContentP');

	public $hasAndBelongsToMany = array("Profile");

}
?>