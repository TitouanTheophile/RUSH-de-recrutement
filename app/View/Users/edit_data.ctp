<div id="user_header">
	<?= $this->element('user_photo', array('user' => $this->Session->read('Auth.User'))); ?>
</div>
<div id="user_edit">
	<div class="container_padding">
		<h4>Éditer les cordonnées de mon profil</h4>
		<hr />
		<div class="container_padding">
			<?php
				echo $this->Form->create('User');
				echo $this->Form->input('firstname', array('label' => 'Votre prénom :', 'type' => 'hidden'));
				echo $this->Form->input('lastname', array('label' => 'Votre nom :', 'type' => 'hidden'));
				echo $this->Form->input('email', array('label' => 'Adresse email :'));
				echo $this->Form->input('id', array('type' => 'hidden'));
				echo $this->Form->end('Mettre à jour mon profil');
			?>
				<hr />
			<?php
				echo $this->Form->postLink(
                'Supprimer mon compte',
                array('action' => 'delete', $user['User']['id']),
                array('confirm' => "Attention cette action est irréversible.\nÊtes-vous sûr(e) de vouloir continuer ?"));
            ?>
		</div>

	</div>
</div>