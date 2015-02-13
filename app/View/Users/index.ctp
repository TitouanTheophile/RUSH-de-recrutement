<h3>User Index</h3>
    <?php echo $this->Html->link("Se deconnecter",
    array('controller' => 'users', 'action' => 'logout')); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Firstname</th>
        <th>Lastname</th>
		<th>[ Actions ]</th>
        <th>Study Place</th>
        <th>Work Place</th>
        <th>User Place</th>
        <th>Email</th>
    </tr>

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['User']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($user['User']['firstname'],
            array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?>
        </td>
        <td><?php echo $user['User']['lastname']; ?></td>

        <td>
        	<?php echo $this->Form->postLink(
                'Supprimer',
                array('action' => 'adminDelete', $user['User']['id']),
                array('confirm' => 'Etes-vous sûr ?'));
            ?>
        </td>

        <td><?php echo $user['User']['study_place']; ?></td>
        <td><?php echo $user['User']['work_place']; ?></td>
        <td><?php echo $user['User']['user_place']; ?></td>
        <td><?php echo $user['User']['email']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>