<?= $this->Html->css('home', array('inline' => false)); ?>
<div id="login_form">
	<h3>Se connecter</h3>
	<?= $this->Form->create('User'); ?>
		<?= $this->Form->input('email', array('label' => 'Identifiant :')); ?>
		<?= $this->Form->input('password', array('label' => 'Mot de passe :')); ?>
	<?= $this->Form->end("Connexion"); ?>
</div>
