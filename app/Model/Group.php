<?php

class Group extends AppModel {
public $validate = array(
	'name' => array(
		'rule' => 'url',
		'allowEmpty' => false,
		'required' => true,
		'message' => 'FAUX'));

	public function is_valid($data)
	{
		return false;
	debug($data);
	}
}
?>