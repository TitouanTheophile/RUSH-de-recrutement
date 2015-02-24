<?php

class Group extends AppModel {

	// public $validate = array(
	// 'name' => array(
	// 	'allowEmpty' => false,
	// 	'required' => true
	// 	));


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