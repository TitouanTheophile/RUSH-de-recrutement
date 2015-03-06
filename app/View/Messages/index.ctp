<?= $this->Html->script('searchUsersMessages', array('inline' => false)); ?>
<?= $this->Html->css('message', array('inline' => false)); ?>
<h3>Messages</h3>
<label for="ProfileId_messages">Destinataire</label>
<input type="text" id="ProfileId_messages">
<div id="results_search_messages"></div>
<div id="messages">
<?php
	foreach ($messages as $message) {
		$from = $this->Html->link(
			$message['From']['firstname'] . ' ' . $message['From']['lastname'],
			array('controller' => 'Users', 'action' => 'view', $message['From']['id']),
			array('escape' => false, 'class' => 'message_author')
		);
		$to = $this->Html->link(
			$message['To']['firstname'] . ' ' . $message['To']['lastname'],
			array('controller' => 'Users', 'action' => 'view', $message['To']['id']),
			array('escape' => false, 'class' => 'message_author')
		);
		$date = $this->Html->tag(
			'span',
			$this->Time->format($message['Message']['created'], '%e/%m/%G %H:%M'),
			array('class' => 'message_date')
		);
		$message_content = $this->Html->tag(
			'span',
			$this->Text->truncate(htmlentities($message['Message']['content']), 80, array('ellipsis' => '...')),
			array('class' => 'message_text')
		);
		$link = $this->Html->link(
			'Voir tous les messages',
			array('controller' => 'messages', 'action' => 'send', ($message['From']['id'] == $this->Session->read("Auth.User.id") ? $message['To']['id'] : $message['From']['id']))
		);
		echo $this->Html->div('message_div', $from . ' → ' .$to . $date . $message_content . $link);
	}
?>
</div>