<?php
foreach ($messages as $message) {
	$id = $message['From']['id'];
	$firstname = $message['From']['firstname'];
	$lastname = $message['From']['lastname'];
	
	echo $this->Html->link(
		"$firstname $lastname ",
		array('controller' => 'Users', 'action' => 'view', $message['From']['id']),
		array('escape' => false)
		);
	echo ($this->Time->format($message['Message']['created'], '%e/%m/%G %H:%M') . '<br>' . $message['Message']['content'] . '<br><br>');
}
?>