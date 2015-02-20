<script type='text/javascript' src='http://code.jquery.com/jquery-1.7.1.min.js'></script>

<?= $this->Html->script('text_area');?>
<?= $this->Form->create('Comments'); ?>
<div class="comments">	
<?php foreach ($comment as $text)
{
	echo "<div class='comment'>".
	$this->Html->link($text['users']['firstname']." ".$text['users']['lastname'],
	array('controller' => 'Users', 'action' => 'view',
		$text['Comment']['from_id']), array("class" => "profile_links")).
		"<xmp style='display:inline'>"." ".$text['Comment']['content'].
		"</xmp><br /><span class='comment_date'>".
		$text['Comment']['created'].
		"</span></div>";
}
?>
<div class="comment_area">
<?= $this->Form->textarea('text-area', array('label' => '', 
										  "placeholder" => "Écrire un commentaire...",
										  "class" => "common ",
										  "value" => "",
										  "required"));?>

<?= $this->Form->button("Publier", array('class' => 'comment_button', 'type' => 'button','value' => $content['Content']['id'])); ?>
<?= $this->Form->end();?>
</div>
</div>