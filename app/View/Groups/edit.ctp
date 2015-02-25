<?=$this->Html->css('buttons', array('inline' => false));?>
<div>
<h1 align="center">Creer un nouveau groupe</h1>
<?= $this->Form->create('Info', array('novalidate')); ?>
<?= $this->Form->input('text', array(
									'label' => "Nom du groupe :<font color=\"red\">*</font>", 
									"placeholder" => $group['Group']['name'])
						);
 ?>

 <?= $this->Form->input('text-area', array(
									'label' => "Description du groupe :",
									"placeholder" => $group['Group']['description'])
						);
 ?>
<?= $this->Form->button("Annuler", array(
	'class' => 'submit cancel_button',
	'formaction' => Router::url(
		array('controller' => 'groups','action' => 'view/' . $id)
	)
)); ?>
<?= $this->Form->button("Créer", array('class' => 'submit create_button')); ?>

</div>
