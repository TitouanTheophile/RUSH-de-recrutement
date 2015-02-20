<?php

class Content extends AppModel {
	public $displayField = 'content_id';

	public $belongsTo = array(
		'User' => array(
			'foreignKey' => 'id'),
		'Group' => array(
			'foreignKey' => 'id'));

	public $hasMany = array('ContentP');

}
?>