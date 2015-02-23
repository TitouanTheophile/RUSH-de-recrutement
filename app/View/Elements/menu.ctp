<?php $user = $this->Session->read('Auth.User'); ?>
<?= $this->Html->script('menu-responsive.js', array('inline' => false)); ?>
<div id="header_menu">
	<?= $this->Html->link("Fil d'actualité", array('controller' => 'users', 'action' => 'news', $user['id'])); ?>
	<?= $this->Html->link("Mes Amis", array('controller' => 'users', 'action' => 'friends', $this->Session->read('Auth.User.id') )); ?>
	<?= $this->Html->link("Profil", array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
	<?= $this->Html->link("Albums photos", array('controller' => 'albums', 'action' => 'index', $user['id'])); ?>
	<?= $this->Html->link("Messages", array('controller' => 'messages', 'action' => 'index')); ?>
</div>