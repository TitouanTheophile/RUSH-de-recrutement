<div id="header_option">
	<div id="header_option_drop">
		<?= $this->Html->link("Changer ma photo", array('controller' => 'users', 'action' => 'editPhoto', $this->Session->read('Auth.User.id'))); ?>
		<?= $this->Html->link("Editer mes infos publiques", array('controller' => 'users', 'action' => 'editInfo', $this->Session->read('Auth.User.id'))); ?>
		<?= $this->Html->link("Editer mes cordonnees", array('controller' => 'users', 'action' => 'editData', $this->Session->read('Auth.User.id'))); ?>
		<?= $this->Html->link("Deconnexion", array('controller' => 'users', 'action' => 'logout')); ?>
	</div>
</div>