<div id="profile_header">
	<?php 
		echo $this->element('profile_photo');
	?>
</div>

<div class="profile_publication">
	<?php
		echo $this->Form->create('Post');
		echo $this->Form->input('content', array('label' => 'Votre texte :', 'type' => 'textarea'));
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->end("Publier");
	?>
</div>