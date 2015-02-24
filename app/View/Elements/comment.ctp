<script type='text/javascript' src='http://code.jquery.com/jquery-1.7.1.min.js'></script>

<?= $this->Html->script('text_area');?>
<?= $this->Form->create('Comments'); ?>
<div class="comments">	
<?php

 foreach ($comment as $text)
{
	$user_picture = (!file_exists(IMAGES.'avatars/'.$text['Comment']['from_id'].'.jpg') ?
					   'inconnu.jpg' : 'avatars/'.$text['Comment']['from_id'].'.jpg');
	$scale = getimagesize(IMAGES . '/' . $user_picture);
	$scale = ($scale[0] >= $scale[1] ? 'large' : 'long');
	$user_picture = $this->Html->link($this->Html->image($user_picture, array('alt' => 'Photo de profil', 'class' => $scale)),
					array('action' => 'view', $text['Comment']['from_id']),
    				array('escape' => false, 'class' => 'comment_header_pic'));
	echo "<div class='comment'>".$user_picture.
	$this->Html->link($text['users']['firstname']." ".$text['users']['lastname'],
	array('controller' => 'Users', 'action' => 'view',
		$text['Comment']['from_id']), array("class" => "profile_links")).
		"<xmp style='display:inline'>"." ".$text['Comment']['content'].
		"</xmp><br /><span class='comment_date'>".
		"Envoyé il y a ". $text['Comment']['created'] .
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