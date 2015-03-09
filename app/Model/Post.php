<?php

class Post extends AppModel {
	public $hasOne = array(
		'Content' => array(
			'foreignKey' => 'id',
			'condition' => 'contentType_id = 1'
			)
		);

	public $validate = array(
    	'content' => array(
        	'rule'    => array('minLength', 1),
        	'required'   => true,
        	'allowEmpty' => false,
        	'on'         => 'create',
        	'message'    => 'Votre post est vide...'
    	));
}
?>