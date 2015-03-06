<?php
class Message extends AppModel {

	public $belongsTo = array(
		'From' => array(
			'className' => 'Users',
			'foreignKey' => 'from_id'
			),
		'To' => array(
			'className' => 'Users',
			'foreignKey' => 'target_id'
			)
		);

	public $validate = array(
    	'content' => array(
        	'rule'    => array('minLength', 1),
        	'required'   => true,
        	'allowEmpty' => false,
        	'on'         => 'create',
        	'message'    => 'Veuillez remplir un message avant d\'envoyer'
    	));

}
?>