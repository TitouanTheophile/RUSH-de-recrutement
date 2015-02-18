<?= $this->Html->css('friend', array('inline' => false)); ?>
<div id="user_header">
	<?= $this->element('user_photo', array('user' => $user['User']));	?>
</div>

<div class="user_publication">
	<h4><?php
		if ( $this->Session->read('Auth.User.id') == $user['User']['id'] ) {
			echo "Liste de vos amis";
		}
		else {
			echo "Liste des amis de ".$user['User']['firstname']." ".$user['User']['lastname'];
		}
	?></h4>
	<?php

		$friends_verification = $this->requestAction(
			'friends/isFriend',
			array('pass' => array($this->Session->read('Auth.User.id'), $user['User']['id']))
		);

		$index = count($my_friends);
	    while($index) {
	    	$my_friend = $my_friends[--$index];
			echo $this->element('friend_photo', array("my_friend" => $my_friend));
		}
		unset($my_friend);

	?>
</div>