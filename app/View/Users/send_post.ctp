<div id="user_header">
	<?= $this->element('user_photo', array('user' => $this->Session->read('Auth.User'))); ?>
</div>
<div class="user_publication">
	<?php
		echo $this->Form->create('Post');
		echo $this->Form->input('content', array('label' => 'Votre texte :', 'type' => 'textarea'));
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->end("Publier");
	?>
</div>