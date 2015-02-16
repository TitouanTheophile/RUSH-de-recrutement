<div id="user_header">
	<?= $this->element('user_photo', array('user' => $this->Session->read('Auth.User'))); ?>
</div>

<div id="user_edit">
	<div class="container_padding">
		<h4>Éditer les informations publiques de mon profil</h4>
		<hr />
		<div class="container_padding">
			<?php
				echo $this->Form->create('User');

				echo $this->Form->input('firstname', array('label' => 'Votre prénom :'));
				echo $this->Form->input('lastname', array('label' => 'Votre nom :'));
				echo $this->Form->input('study_place', array('label' => "Votre lieu d'étude :"));
				echo $this->Form->input('work_place', array('label' => 'Votre lieu de travail :'));
				echo $this->Form->input('user_place', array('label' => "Votre lieu d'habitation :"));
				echo $this->Form->input('birthday', array('label' => "Votre date d'anniversaire :"));
				echo $this->Form->input('id', array('type' => 'hidden'));

				echo $this->Form->end('Mettre à jour mon profil');
			?>
		</div>

	</div>
</div>