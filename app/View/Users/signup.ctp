<?= $this->Html->css('home', array('inline' => false)); ?>
<h1>Bienvenue sur SocialKOD !</h1>
<div id="signup_logo">
	<?= $this->Html->image('logo_terre.png', array('alt' => 'CakePHP')); ?>
</div>
<div id="signup_form">
	<div class="container_padding20">
		<h3>S'inscrire</h3>
		<?= $this->Form->create('User'); ?>
			<?= $this->Form->input('firstname', array('label' => 'Prénom :')); ?>
			<?= $this->Form->input('lastname', array('label' => 'Nom :')); ?>
			<?= $this->Form->input('email', array('label' => 'Adresse email :')); ?>
			<?= $this->Form->input('password', array('label' => 'Mot de passe :')); ?>
			<?= $this->Form->input('password_confirmation', array('label' => 'Confirmation de mot de passe :', 'type' => 'password')); ?>
			<?= $this->Form->input('id', array('type' => 'hidden')); ?>
		<?= $this->Form->end("S'enregistrer sur le meilleur réseau social au monde !!"); ?>
		<strong>Plus d'options de personnalisation seront disponibles une fois votre compte créé et validé.</strong>
	</div>
</div>