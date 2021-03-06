<?php

class Group extends AppModel {
	public $hasMany = array(
        'Content' => array('foreignKey' => 'target_id')
    );

	public $hasAndBelongsToMany = array(
        'User' => array(
            'className' => 'User',
            'joinTable' => 'groups_users',
            'foreignKey' => 'group_id',
            'associationForeignKey' => 'user_id'
            )
    );

    public $belongsTo = array(
        'Owner' => array(
            'className' => 'Users',
            'foreignKey' => 'owner_id'
            )
    );

    public $validate = array(
        'name' => array(
            'rule' => '/^.+$/i',
            'required' => true,
            'allowEmpty' => false,
            'on'         => 'create',
            'message'  => 'Ce champ est requis!'
        )
    );
}
?>