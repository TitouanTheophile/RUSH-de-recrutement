<?= $this->Html->script('getMessages', array('inline' => false)); ?>
<?= $this->Html->css('message', array('inline' => false)); ?>
<?= $this->Html->css('users', array('inline' => false)); ?>
<?= $this->Html->div(null, $this->element('user_photo', array('user' => $To)), array('id' => 'user_header')); ?>
<div id="messages"></div>
<?= $this->Form->create('Message'); ?>
	<?= $this->Form->input('content', array('label' => 'Contenu du message')); ?>
<?= $this->Form->end('Envoyer'); ?>