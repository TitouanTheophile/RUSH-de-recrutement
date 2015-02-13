<?php

class Group extends AppModel {
	public $validate = array(
	'name' => array(
		'rule' => 'url',
		'allowEmpty' => false,
		'required' => true,
		'message' => 'FAUX'));

	public $hasMany = array(
		'Content' => array(
			'foreignKey' => 'target_id'));

	public function is_valid($data)
	{
		return false;
	debug($data);
	}
}
?>