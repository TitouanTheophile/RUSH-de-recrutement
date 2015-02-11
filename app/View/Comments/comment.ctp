<?=$this->Html->css('comment');?>

<?="<script type='text/javascript' src='http://code.jquery.com/jquery-1.7.1.min.js'></script>"?>

<?=$this->Html->script('text_area');?>
<?= $this->Form->create('post', array('novalidate')); ?>
<?= "<div>"?>
<?= $this->Form->textarea('text-area', array('label' => '', 
										  "placeholder" => "Écrire un commentaire...",
										  "onkeyup" => "textAreaAdjust(this)",
										  "class" => "comment_area"));?>
<?= $this->Form->button("Publier", array('class' => 'submit post_button'
										 )); ?>
<?= "</div>"?>