<?php
$users = array_filter($users);
if (empty($users))
	echo "<h3>Pas de résultat :(</h3>";
foreach ($users as $user)
{
	$picture = $this->Html->image(
		(!file_exists(IMAGES . 'avatars/' . $user['User']['id'] . '.jpg') ? 'inconnu.jpg' : 'avatars/' . $user['User']['id'] . '.jpg'),
		array('alt' => 'Photo de profil', 'class' => 'search')
	);
	$name = $this->Html->tag(
		'span',
		$this->Text->truncate($user['User']['firstname'], 25) . ' ' . $this->Text->truncate($user['User']['lastname'], 25)
	);
	echo $this->Html->link(
		$picture . $name,
		array('controller' => 'messages', 'action' => 'send', $user['User']['id']),
		array('escape' => false, 'class' => 'user')
	);
}
?>