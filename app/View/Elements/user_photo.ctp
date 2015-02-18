<?= $this->Html->css('users', array('inline' => false)); ?>
<div id="user_element">
	<div id="user_element_photo">
		<?php
				if ( empty($user['picture_id']) || $user['picture_id'] == NULL ) {
					echo $this->Html->link(
				        $this->Html->image('inconnu.jpg', array('alt' => 'Photo de profil', 'title' => 'Changer ma photo de profil')),
				        array('action' => 'editPhoto', $user['id']),
				        array('escape' => false)
				    );
				}
				else {
					echo $this->Html->link(
				        $this->Html->image( 'avatars/' . $user['picture_id'] . '.jpg', array('alt' => 'Photo de profil', 'title' => 'Changer ma photo de profil')),
				        array('action' => 'editPhoto', $user['id']),
				        array('escape' => false)
				    );
				}
			?>
	</div>
	<div id="user_element_name">
		<?= $this->Html->link($user['firstname']." ".$user['lastname'], array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
	</div>
</div>