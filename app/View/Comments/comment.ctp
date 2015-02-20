<?=$this->Html->css('comment');?>

<?="<script type='text/javascript' src='http://code.jquery.com/jquery-1.7.1.min.js'></script>"?>

<?=$this->Html->script('text_area');?>
<?= $this->Form->create('post', array('novalidate')); ?>
<?= "<div>"?>

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
<?= "</div>"?>