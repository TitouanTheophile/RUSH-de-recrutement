<?php
$groups = array_filter($groups);
if (empty($groups))
	echo "<h3>Aucun groupe trouvé :(</h3>";
else
	echo "<h3>Groupes :</h3>";
foreach ($groups as $group) {
	$name = $this->Html->tag('span', $group['Group']['name']);

	echo $this->Html->link($name,
						   array('controller' => 'groups', 'action' => 'view', $group['Group']['id']),
						   array('escape' => false, 'class' => 'result'));
}
?>