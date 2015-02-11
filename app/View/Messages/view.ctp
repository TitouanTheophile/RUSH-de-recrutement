<?= $this->Html->script('dynamic_refresh_messages'); ?>
<h1><?= $this->params['named']['name'] ?></h1>
<div id="messages"></div>

<?= $this->Form->create('Message'); ?>
	<?= $this->Form->input('content', array('label' => 'Contenu du message')); ?>
<?= $this->Form->end('Envoyer'); ?>