<?= $this->Html->css('album', array('inline' => false)) ?>
<?= $this->Html->div('section_title', "<h3>Modifier l'image</h3>") ?>
<?= $this->Form->create('Picture', array('type' => 'file')); ?>
<?= $this->Html->div('big_pic', $this->Html->image('/img/'. $id .'.jpg', array('alt' => ''))); ?>
<?= $this->Form->input('description', array('label' => 'Description de l\'image :', 'rows' => '5')); ?>
<?= $this->Form->end('Enregistrer'); ?>