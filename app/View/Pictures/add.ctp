<?= $this->Html->css('album', array('inline' => false)) ?>
<?= $this->Html->div('section_title', "<h3>Ajouter une image</h3>") ?>
<?= $this->Form->create('Picture', array('type' => 'file')); ?>
<?= $this->Form->input('img', array('label' => 'Image', 'type' => 'file')); ?>
<?= $this->Form->input('description', array('label' => 'Description de l\'image :', 'rows' => '5')); ?>
<?= $this->Form->end('Ajouter l\'image'); ?>