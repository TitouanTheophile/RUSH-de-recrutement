<h1>Bienvenue sur SocialKOD !</h1>

<div id="signup_logo">
	<?php echo $this->Html->image('logo_terre.png', array('alt' => 'CakePHP')); ?>
</div><!--

--><div id="signup_content">
	<div class="container_padding20">
		<h3>S'inscrire</h3>
		<?php
			echo $this->Form->create('User');

			echo $this->Form->input('firstname', array('label' => 'Prénom :'));
			echo $this->Form->input('lastname', array('label' => 'Nom :'));
			echo $this->Form->input('mail', array('label' => 'Adresse email :'));
			echo $this->Form->input('password', array('label' => 'Mot de passe :'));
			echo $this->Form->input('id', array('type' => 'hidden'));

			echo $this->Form->end("S'enregistrer sur le meilleur réseau social au monde !!");
		?>
		<strong>Plus d'options de personnalisation seront disponibles une fois votre compte créé et validé.</strong>
	</div>
</div>