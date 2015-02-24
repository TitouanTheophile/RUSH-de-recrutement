<?=$this->Html->css('comment', array('inline' => false));?>
<?=$this->Html->script('text_area', array('inline' => false));?>
<?= $this->Form->create('post', array('novalidate')); ?>
<div>
	<?php foreach ($comment as $text)
		{
			echo "<div class='comments'>".
			$this->Html->link($text['users']['firstname']." ".$text['users']['lastname'] . " ",
			array('controller' => 'Users', 'action' => 'view',
				 $text['Comment']['from_id'])).
				 $text['Comment']['content'].
				 "<br /> <span class='comment_date'>".
				 $text['Comment']['created'].
				 "</span></div>";
		}
	?>
	<?= $this->Form->textarea('text-area', array('label' => '', 
											  "placeholder" => "Écrire un commentaire...",
											  "onkeyup" => "textAreaAdjust()",
											  "class" => "comment_area",
											  "value" => "",
											  "required"));?>
	<?= $this->Form->button("Publier", array('class' => 'submit comment_button')); ?>
</div>