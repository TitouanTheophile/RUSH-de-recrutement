<?= $this->Html->script('dynamic_search_messages', array('inline' => false)); ?>
<?= $this->Html->css('message', array('inline' => false)); ?>
<h3>Messages</h3>
<label for="ProfileId_messages">Destinataire</label>
<input type="text" id="ProfileId_messages">
<div id="results_search_messages"></div>
<div id="messages">
<?php
	foreach ($messages as $message) {
		$head = $this->Html->link($message['From']['firstname'] . ' ' . $message['From']['lastname'],
							   	  array('controller' => 'Users', 'action' => 'view', $message['From']['id']),
							   	  array('escape' => false, 'class' => 'message_author'));
		$head .= ' → '. $this->Html->link($message['To']['firstname'] . ' ' . $message['To']['lastname'],
							   			  array('controller' => 'Users', 'action' => 'view', $message['To']['id']),
							   			  array('escape' => false, 'class' => 'message_author'));
		$head = $this->Html->tag('span', $head, array('class' => 'message_head'));
		$message_content  = $head;
		$message_content .= $this->Html->tag('span', $this->Time->format($message['Message']['created'], '%e/%m/%G %H:%M'),
																		 array('class' => 'message_date'));
		$message_content .= $this->Html->tag('span', $this->Text->truncate(htmlentities($message['Message']['content']), 80, array('ellipsis' => '...')),
											 array('class' => 'message_text'));
		$message_content .= $this->html->tag('span', $this->Html->link('Voir tous les messages', $message['Message']['url']),
											 array('class' => 'message_link'));
		echo $this->Html->div('message_div', $message_content);
	}
?>
</div>
