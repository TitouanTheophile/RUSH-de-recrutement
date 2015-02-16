<?php

class Notification extends AppModel {
	public $belongsTo = array( //Make the link beetween tables
		'From' => array(
			'className' => 'Users',
			'foreignKey' => 'from_id'
			),
		'To' => array(
			'className' => 'Users',
			'foreignKey' => 'target_id'
			),
		'NotificationTypes' => array(
			'className' => 'NotificationType',
			'foreignKey' => 'notificationType_id'
			)
		);
}
?>