<?php
$users = array_filter($users);
if (empty($users))
	echo "<h3>Pas de résultat :(</h3>";
foreach ($users as $user) {
	$picture = $this->Html->image((!file_exists(IMAGES . 'avatars/' . $user['User']['id'] . '.jpg') ? 'inconnu.jpg' : 'avatars/' . $user['User']['id'] . '.jpg'),
								  array('alt' => 'Photo de profil', 'class' => 'search'));
	$name = $this->Html->tag('span', $user['User']['firstname'] . ' ' . $user['User']['lastname']);
	echo $this->Html->link($picture . $name,
						   array('controller' => 'users', 'action' => 'view', $user['User']['id']),
						   array('escape' => false, 'class' => 'user'));
}
?>