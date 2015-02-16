<?= $this->Html->css('users', array('inline' => false)); ?>
<div id="user_element">
	<div id="user_element_photo">
		<?= $this->Html->image((empty($user['picture_id']) ? 'inconnu.jpg' : $user['picture_id']),
									  array('alt' => 'Photo de profil',
										    'url' => array('controller' => 'users', 'action' => 'view', $user['id'])));
		?>
	</div>
	<div id="user_element_name">
		<?= $this->Html->link($user['firstname']." ".$user['lastname'], array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
	</div>
</div>