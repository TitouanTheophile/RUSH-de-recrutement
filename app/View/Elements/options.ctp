<div id="header_option"><span id="option_drop">⚙</span>
<div id="header_option_drop">
	<?= $this->Html->link("Changer ma photo", array('controller' => 'users', 'action' => 'editPhoto', $this->Session->read('Auth.User.id'))); ?>
	<?= $this->Html->link("Éditer mes infos publiques", array('controller' => 'users', 'action' => 'editInfo', $this->Session->read('Auth.User.id'))); ?>
	<?= $this->Html->link("Éditer mes cordonnées", array('controller' => 'users', 'action' => 'editData', $this->Session->read('Auth.User.id'))); ?>
	<?= $this->Html->link("Déconnexion", array('controller' => 'users', 'action' => 'logout')); ?>
</div>
</div>
