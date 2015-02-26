<?= $this->Html->css('album', array('inline' => false)) ?>
<h3 class="section_title">Modifier l'image</h3>
<?= $this->Form->create('Picture', array('type' => 'file')); ?>
	<div class="big_pic">
		<?= $this->Html->image('/img/'. $id .'.jpg', array('alt' => '')); ?>
	</div>
	<?= $this->Form->input('description', array('label' => 'Description de l\'image :', 'rows' => '5')); ?>
<?= $this->Form->end('Enregistrer'); ?>