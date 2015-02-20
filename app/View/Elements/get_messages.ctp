<?php
foreach ($messages as $message) {
	$id = $message['From']['id'];
	$firstname = $message['From']['firstname'];
	$lastname = $message['From']['lastname'];
	$message_content = $this->Html->link("$firstname $lastname ",
						   array('controller' => 'Users', 'action' => 'view', $message['From']['id']),
						   array('escape' => false, 'class' => 'message_author'));
	$message_content .= $this->Html->tag('span', $this->Time->format($message['Message']['created'], '%e/%m/%G %H:%M'), array('class' => 'message_date'));
	$message_content .= $this->Html->tag('span', htmlentities($message['Message']['content']), array('class' => 'message_text'));
	echo $this->Html->div('message_div', $message_content);
}
?>