<?= $this->Html->css('album', array('inline' => false)) ?>
<?= $this->Html->css('users', array('inline' => false)); ?>
<?= $this->Html->div('section_title', "<h3>Modifier l'album</h3>") ?>
<?= $this->Form->create(); ?>
<?= $this->Form->input('title', array('label' => 'Nom de l\'album :')); ?>
<?= $this->Form->input('description', array('label' => 'Description de l\'album :', 'rows' => '5')); ?>
<?= $this->Form->end('Enregistrer'); ?>