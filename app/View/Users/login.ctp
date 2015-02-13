
<div id="signin_form">

<h3>Se connecter</h3>

<?php
	echo $this->Form->create('User');

	echo $this->Form->input('email', array('label' => 'Identifiant :'));
	echo $this->Form->input('password', array('label' => 'Mot de passe :'));

	echo $this->Form->end("Connexion");
?>

</div>

