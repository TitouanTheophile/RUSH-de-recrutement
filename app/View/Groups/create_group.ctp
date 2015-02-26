<?=$this->Html->css('buttons', array('inline' => false));?>
<div>
<h1 align="center">Creer un nouveau groupe</h1>
<?= $this->Form->create('Group'); ?>
			<?= $this->Form->input('name', array('label' => 'Nom du groupe :')); ?>
			<?= $this->Form->input('description', array('label' => 'Description :')); ?>
<?= $this->Form->end("Créer le groupe"); ?>
</div>
