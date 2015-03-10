<?php

class NotificationsController extends AppController {

	public function getNotifications()
	{
		$notifications = $this->Notification->find('all', array(
			'conditions' => array(
				'target_id' => $this->Auth->user('id'),
				),
			'order' => 'created DESC',
			'limit' => 5,
			'contain' => array(
				'From' => array(
					'fields' => array('firstname', 'lastname', 'id')
					),
				'To'=> array(
					'fields' => array('firstname', 'lastname', 'id')
					),
				'NotificationTypes.name'
				)
			)
		);
		$this->set('notifications', $notifications);
		$this->layout = false;
		$this->render('/Elements/notifications');
	}

	public function getNotificationsCount()
	{
		$notifications_count = $this->Notification->find('count', array(
			'conditions' => array(
					'target_id' => $this->Auth->user('id'),
					'viewed' => 0
				)
			)
		);
		$this->set('notifications_count', $notifications_count);
		$this->layout = false;
		$this->render('/Elements/notifications_count');
	}

}
?>