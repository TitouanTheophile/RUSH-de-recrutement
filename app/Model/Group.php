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

	public $hasAndBelongsToMany = array(
        'User' =>
            array(
                'className' => 'User',
                'joinTable' => 'groups_users',
                'foreignKey' => 'group_id',
                'associationForeignKey' => 'user_id',
            )
    );

	public function is_valid($data)
	{
		return false;
	debug($data);
	}
}
?>