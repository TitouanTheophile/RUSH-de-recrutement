<div class="user_element">
	<div class="user_element_photo">
		<?= $this->element('user_pic', array('id' => $user['id'],
											 'url' => array('controller' => 'users', 'action' => 'view', $user['id']),
											 'class' => '')); ?>
	</div>
	<div class="user_element_name">
		<?= $this->Html->link($user['firstname']." ".$user['lastname'], array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
	</div>
</div>