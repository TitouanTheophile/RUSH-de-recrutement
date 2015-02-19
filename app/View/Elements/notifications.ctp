<?= $this->Html->script('notifications_display', array('inline' => false)); ?>
<?php $notifications = $this->requestAction(array('controller' => 'notifications', 'action' => 'get_notifications')); ?>
<?php $notifications_count = $this->requestAction(array('controller' => 'notifications', 'action' => 'get_count')); ?>
<?= $this->Html->image('logo-notifications.png', array('id' => 'notifications')); ?>
<?php
if (isset($notifications_count) && $notifications_count > 0)
	echo $this->Html->div(null, $notifications_count, array('id' => 'notifications_count'));
?>
<div id="notifications_list">
<?php 
	foreach ($notifications as $notification) {
		$firstname = $notification['From']['firstname'];
		$lastname = $notification['From']['lastname'];
		$date = $this->Time->format($notification['Notification']['created'], '%#d/%m/%y');
		$date_time = $this->Time->format($notification['Notification']['created'], '%H:%M');
		$pic_url = (!file_exists(IMAGES . 'avatars' . DS . $notification['From']['id'] . '.jpg') ? 'inconnu.jpg' : $notification['From']['id'] . '.jpg');
		$picture = $this->Html->image($pic_url, array('alt' => 'Photo de profil', 'class' => 'search'));
		if ($notification['NotificationTypes']['name'] == 'Message')
			$sentence = $this->Html->tag('span', "$firstname $lastname vous a envoyé un message le $date ȧ $date_time");
		echo $this->Html->link($picture . $sentence,
							   array('controller' => 'messages', 'action' => 'send', $notification['From']['id']),
							   array('escape' => false));
	}
?>
</div>