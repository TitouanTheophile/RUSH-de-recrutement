<?php $user = $this->Session->read('Auth.User'); ?>
<div id="header_menu">
	<?= $this->Html->link("Fil d'actualité", array('controller' => 'users', 'action' => 'news', $user['id'])); ?>
	<?= $this->Html->link("Profil", array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
	<?= $this->Html->link("Albums photos", array('controller' => 'albums', 'action' => 'index')); ?>
	<?= $this->Html->link("Messages", array('controller' => 'messages', 'action' => 'index')); ?>
</div>