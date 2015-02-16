<?php

class NotificationsController extends AppController {

	public function get_notifications() {
		return $notifications = $this->Notification->find('all', array(
			'conditions' => array(
				'Notification.target_id' => $this->Auth->user('id'),
				),
			'order' => 'Notification.created DESC',
			));
	}

	public function get_count() {
		return $notifications_count = $this->Notification->find('count', array(
			'conditions' => array(
				'AND' => array(
					'Notification.target_id' => $this->Auth->user('id'),
					'Notification.viewed' => 0
					)
				),
			));
	}

}
?>