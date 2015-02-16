<?= $this->Html->script('jquery', array('inline' => false)); ?>
<?= $this->Html->script('dynamic_refresh_messages', array('inline' => false)); ?>
<?= $this->Html->css('message', array('inline' => false)); ?>
<?= $this->Html->link(
	'<h1 id ="message_profile_name">' . $from['User']['firstname'] . ' ' . $from['User']['lastname'] . '</h1>',
	array('controller' => 'users', 'action' => 'view', $from['User']['id']),
	array('escape' => false)
	);?>
<div id="profile_element_photo">
	<?php
	if ( empty($from['User']['picture_id']) || $from['User']['picture_id'] == NULL ) {
		echo $this->Html->link(
			$this->Html->image('inconnu.jpg', array('alt' => 'Photo de profil')),
			array('controller' => 'users', 'action' => 'view', $from['User']['id']),
			array('escape' => false)
			);
	}
	else {
		echo $this->Html->link(
			$this->Html->image( $from['User']['picture_id'] . '.jpg', array('alt' => 'Photo de profil')),
			array('controller' => 'users', 'action' => 'editPhoto', $from['User']['id']),
			array('escape' => false)
			);
	}
	?>
</div>
<div id="messages" style="overflow-y:scroll; height:400px;"></div>
<?= $this->Form->create('Message'); ?>
	<?= $this->Form->input('content', array('label' => 'Contenu du message')); ?>
<?= $this->Form->end('Envoyer'); ?>