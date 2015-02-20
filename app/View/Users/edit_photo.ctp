<?= $this->Html->css('users', array('inline' => false)); ?>
<div id="user_header">
	<?= $this->element('user_photo', array('user' => $this->Session->read('Auth.User'))); ?>
</div>
<div id="user_edit">
	<div class="container_padding">
		<h4>Changer ma photo de profil</h4>
		<hr />
		<div class="container_padding">
			<?php
				echo $this->Form->create('User', array('type' => 'file'));
				echo $this->Form->input('avatar_file', array('label' => 'Votre avatar (au format jpg ou png)', 'type' => 'file'));
				echo $this->Form->end('Mettre à jour ma photo de profil');
			?>
		</div>

	</div>
</div>