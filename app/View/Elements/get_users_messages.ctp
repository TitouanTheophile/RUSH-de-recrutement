<?php
$users = array_filter($users);
if (empty($users))
	echo "<h3>Pas de résultat :(</h3>";
foreach ($users as $user) {
	$id = $user['User']['id'];
	$firstname = $user['User']['firstname'];
	$lastname = $user['User']['lastname'];
	if ( empty($from['User']['picture_id']) || $from['User']['picture_id'] == NULL )
		$picture = $this->Html->image('inconnu.jpg', array('alt' => 'Photo de profil', 'class' => 'search'));
	else
		$picture = $this->Html->image( $user['User']['picture_id'] . '.jpg', array('alt' => 'Photo de profil', 'class' => 'search'));

	echo $this->Html->link(
		"<div class='User'>$picture$firstname $lastname</div></a>",
		array('action' => 'send', $user['User']['id']),
		array('escape' => false)
		);
}
?>