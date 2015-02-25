<?= $this->Html->css('album', array('inline' => false)) ?>
<h3 class="section_title">Nouvel album</h3>
<?= $this->Form->create(); ?>
	<?= $this->Form->input('title', array('label' => 'Nom de l\'album :')); ?>
	<?= $this->Form->input('description', array('label' => 'Description de l\'album :', 'rows' => '5')); ?>
<?= $this->Form->end('Créer l\'album'); ?>