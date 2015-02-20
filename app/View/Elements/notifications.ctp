<?php 
	foreach ($notifications as $notification) {
		$firstname = $notification['From']['firstname'];
		$lastname = $notification['From']['lastname'];
		$date = $this->Time->format($notification['Notification']['created'], '%#d/%m/%y');
		$date_time = $this->Time->format($notification['Notification']['created'], '%H:%M');
		$pic_url = (!file_exists(IMAGES . 'avatars' . DS . $notification['From']['id'] . '.jpg') ? 'inconnu.jpg' : 'avatars' . DS .$notification['From']['id'] . '.jpg');
		$picture = $this->Html->image($pic_url, array('alt' => 'Photo de profil', 'class' => 'search'));
		if ($notification['NotificationTypes']['name'] == 'Message') {
			$sentence = $this->Html->tag('span', "$firstname $lastname vous a envoyé un message le $date ȧ $date_time");
			$controller = 'messages';
			$action = 'send';
			$param = $notification['From']['id'];
		}
		if ($notification['NotificationTypes']['name'] == 'Add_friend') {
			$sentence = $this->Html->tag('span', "$firstname $lastname vous a demandé en ami le $date ȧ $date_time");
			$controller = 'users';
			$action = 'friends';
			$param = $this->Session->read('Auth.User.id');
		}
		if ($notification['NotificationTypes']['name'] == 'Accept_friend') {
			$sentence = $this->Html->tag('span', "$firstname $lastname vous a accepté en ami le $date ȧ $date_time");
			$controller = 'users';
			$action = 'view';
			$param = $notification['From']['id'];
		}
		if ($notification['NotificationTypes']['name'] == 'Accept_friend') {
			$sentence = $this->Html->tag('span', "$firstname $lastname vous a accepté en ami le $date ȧ $date_time");
			$controller = 'users';
			$action = 'view';
			$param = $notification['From']['id'];
		}
		echo $this->Html->link($picture . $sentence,
							   array('controller' => $controller, 'action' => $action, $param),
							   array('escape' => false));
	}
?>