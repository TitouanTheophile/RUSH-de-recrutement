<div id="user_element">
	<div id="user_element_photo">
		<?php
			$picture = (!file_exists(IMAGES . 'avatars' . DS . $user['id'] . '.jpg') ? 'inconnu.jpg' : 'avatars' . DS .  $user['id'] . '.jpg');
			$scale = getimagesize(IMAGES . DS. $picture);
			$scale = ($scale[0] >= $scale[1] ? 'large' : 'long');
			$picture = $this->Html->image($picture, array('alt' => 'Photo de profil', 'title' => 'Profil', 'class' => $scale));
			echo $this->Html->link($picture, array('action' => 'view', $user['id']), array('escape' => false));
			?>
	</div>
	<div id="user_element_name">
		<?= $this->Html->link($user['firstname']." ".$user['lastname'], array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
	</div>
</div>