<div class="profile_publication">
	<?php
		echo $this->Form->create('Content');
		echo $this->Form->input('email', array('label' => 'Votre texte :', 'type' => 'textarea'));
		echo $this->Form->end("Publier");
	?>
</div>