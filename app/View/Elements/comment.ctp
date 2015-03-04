<?= $this->Html->script('comment');?>
<div class="comments">

<?php foreach ($comment as $text): ?>

	<div class='comment'>
		<?= $this->element('user_pic', array('id' => $text['Comment']['from_id'],
											 'url' => array('controller' => 'users', 'action' => 'view', $text['Comment']['from_id']),
											 'class' => 'comment_header_pic')); ?>
		<div style="margin-left: 50px;">
		<?= $this->Html->link($text['users']['firstname']." ".$text['users']['lastname'],
							  array('controller' => 'Users', 'action' => 'view', $text['Comment']['from_id']),
							  array("class" => "profile_links")); ?>
		<xmp><?= $text['Comment']['content'] ?></xmp>
		<br /> 
		<span class='comment_date'> Envoyé il y a <?= $text['Comment']['created'] ?></span>
	</div></div>
<?php endforeach ?>
<div class="comment_area">
<?= $this->Form->create('Comments', array( 'action' => "/RUSH/Users/view/9")); ?>
<?= $this->Form->textarea('text-area', array('label' => '', 
										     "placeholder" => "Écrire un commentaire...",
										     "class" => "common ",
										     "value" => "",
										     "required"));?>

<?= $this->Form->button("Publier", array('class' => 'comment_button', 'type' => 'button', 'value' => $id)); ?>
<?= $this->Form->end();?>
</div>
</div>
