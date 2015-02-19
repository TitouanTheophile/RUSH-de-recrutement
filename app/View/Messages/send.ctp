<?= $this->Html->script('dynamic_refresh_messages', array('inline' => false)); ?>
<?= $this->Html->css('message', array('inline' => false)); ?>
<?= $this->Html->css('users', array('inline' => false)); ?>
<?= $this->element('user_photo', array('user' => $from['User'])); ?>
<div id="messages" style="overflow-y:scroll; height:400px;"></div>
<?= $this->Form->create('Message'); ?>
	<?= $this->Form->input('content', array('label' => 'Contenu du message')); ?>
<?= $this->Form->end('Envoyer'); ?>