<?php
foreach ($messages as $message) {
	$name = $this->Html->link(
		$message['From']['firstname'] . $message['From']['lastname'],
		array('controller' => 'Users', 'action' => 'view', $message['From']['id']),
		array('escape' => false, 'class' => 'message_author')
	);
	$date = $this->Html->tag(
		'span',
		$this->Time->format($message['Message']['created'], '%e/%m/%G %H:%M'),
		array('class' => 'message_date')
	);
	$message_content = $this->Html->tag(
		'span',
		htmlentities($message['Message']['content']),
		array('class' => 'message_text')
	);
	echo $this->Html->div('message_div', $name . $date . $message_content);
}
?>