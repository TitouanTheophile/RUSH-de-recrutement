<div class="user_element">
	<div class="user_element_photo">
		<?= $this->element('user_pic', array('id' => $user['id'],
											 'url' => array('controller' => 'users', 'action' => 'view', $user['id']),
											 'class' => '')); ?>
	</div>
	<div class="user_element_name">
		<?= $this->Html->link($this->Text->truncate($user['firstname']." ".$user['lastname'], 25),
							  array('controller' => 'users', 'action' => 'view', $user['id']),
							  array('title' => $user['firstname']." ".$user['lastname'])); ?>
	</div>
</div>