<?= $this->Html->script('notifications_display', array('inline' => false)); ?>
<?php $notifications = $this->requestAction(array('controller' => 'notifications', 'action' => 'get_notifications')); ?>
<?php $notifications_count = $this->requestAction(array('controller' => 'notifications', 'action' => 'get_count')); ?>
<?= $this->Html->image('logo-notifications.png', array('id' => 'notifications')); ?>
<?php
if (isset($notifications_count) && $notifications_count > 0)
	echo ('<div id="notifications_count">' . $notifications_count . '</div>');
?>
<div id="notifications_list">
<?php 
	foreach ($notifications as $notification) {
		$firstname = $notification['From']['firstname'];
		$lastname = $notification['From']['lastname'];
		$date = $this->Time->format($notification['Notification']['created'], '%#d/%m/%y');
		$date_time = $this->Time->format($notification['Notification']['created'], '%H:%M');
		$pic_url = (empty($from['From']['picture_id']) || $from['From']['picture_id'] == NULL ? 'inconnu.jpg' :
																								$notification['From']['picture_id'] . '.jpg');
		$picture = $this->Html->image($pic_url, array('alt' => 'Photo de profil', 'class' => 'search'));
		if ($notification['NotificationTypes']['name'] == 'Message')
			$sentence = "$picture $firstname $lastname vous a envoyé un message le $date ȧ $date_time";
		echo $this->Html->link($this->Html->div('notification', $sentence),
							   array('controller' => 'messages', 'action' => 'send', $notification['From']['id']),
							   array('escape' => false));
	}
?>
</div>