<div id="header_option">
<?php
	$user = $this->Session->read('Auth.User');
	$options = array();
	array_push($options, $this->Html->link("Changer ma photo", array('controller' => 'users', 'action' => 'editPhoto', $user['id'])));
	array_push($options, $this->Html->link("Editer mes infos publiques", array('controller' => 'users', 'action' => 'editInfo', $user['id'])));
	array_push($options, $this->Html->link("Editer mes cordonnees", array('controller' => 'users', 'action' => 'editData', $user['id'])));
	array_push($options, $this->Html->link("Deconnexion", array('controller' => 'users', 'action' => 'logout')));
	echo $this->Html->nestedList($options);
?>
</div>