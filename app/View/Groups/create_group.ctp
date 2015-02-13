<?=$this->Html->css('buttons');?>
<div>
<h1 align="center">Creer un nouveau groupe</h1>
<?= $this->Form->create('Info', array('novalidate')); ?>
<?= $this->Form->input('text', array(
									'label' => "Nom du groupe :<font color=\"red\">*</font>", 
									"placeholder" => "")
						);
 ?>

 <?= $this->Form->input('text-area', array(
									'label' => "Description du groupe :")
						);
 ?>
<?= $this->Form->button("Annuler", array('class' => 'submit cancel_button')); ?>
<?= $this->Form->button("Créer", array('class' => 'submit create_button')); ?>

</div>
