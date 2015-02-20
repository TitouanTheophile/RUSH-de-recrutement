<?php

class NotificationsController extends AppController {

	public function get_notifications() {
		$notifications = $this->Notification->find('all', array(
			'conditions' => array(
				'Notification.target_id' => $this->Auth->user('id'),
				),
			'order' => 'Notification.created DESC',
			));

		$this->set('notifications', $notifications);
		$this->layout = false;
		$this->render('/Elements/notifications');
	}

	public function get_notifications_count() {
		$notifications_count = $this->Notification->find('count', array(
			'conditions' => array(
				'AND' => array(
					'Notification.target_id' => $this->Auth->user('id'),
					'Notification.viewed' => 0
					)
				),
			));

		$this->set('notifications_count', $notifications_count);
		$this->layout = false;
		$this->render('/Elements/notifications_count');
	}

}
?>