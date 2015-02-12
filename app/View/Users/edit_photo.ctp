<div id="user_header">
	<?php 
		echo $this->element('user_photo');
	?>
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