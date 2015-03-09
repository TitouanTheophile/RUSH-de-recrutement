<?= $this->Html->css('users', array('inline' => false)); ?>
<div id="user_header">
	<div id="user_element">
		<div id="user_element_name">
			<?= $this->Html->link($Group['name'], array('controller' => 'groups', 'action' => 'view', $Group['id'])); ?>
		</div>
	</div>
</div>
<div class="user_publication">
	<?php
		echo $this->Form->create('Post');
		echo $this->Form->input('content', array('label' => 'Votre texte :', 'type' => 'textarea'));
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->end("Publier");
	?>
</div>