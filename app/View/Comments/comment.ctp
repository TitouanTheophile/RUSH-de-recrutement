<?=$this->Html->css('comment');?>

<?="<script type='text/javascript' src='http://code.jquery.com/jquery-1.7.1.min.js'></script>"?>

<?=$this->Html->script('text_area');?>
<?= $this->Form->create('post', array('novalidate')); ?>
<?= "<div>"?>

<?php foreach ($comment as $text)
{
	echo "<div class='comments'>".$text['Comment']['content']."</div>";
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