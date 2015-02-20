<?= $this->Html->css('friend', array('inline' => false)); ?>
<?= $this->Html->css('users', array('inline' => false)); ?>
<div id="user_header">
	<?= $this->element('user_photo', array('user' => $user['User']));	?>
</div>
<div class="user_publication">
	<h4><?= ($this->Session->read('Auth.User.id') == $user['User']['id'] ?
			 "Liste de vos amis" : "Liste des amis de ".$user['User']['firstname']." ".$user['User']['lastname']) ?></h4>
	<?php
		foreach ($my_friends as $my_friend)
			echo $this->element('friend_photo', array("my_friend" => $my_friend));
	?>
</div>