<h3>Profile Index</h3>
<table>
    <tr>
        <th>Id</th>
        <th>Firstname</th>
        <th>Lastname</th>
		<th>[ Actions ]</th>
        <th>Study Place</th>
        <th>Work Place</th>
        <th>User Place</th>
        <th>Birthday</th>
    </tr>

    <?php foreach ($profiles as $profile): ?>
    <tr>
        <td><?php echo $profile['Profile']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($profile['Profile']['firstname'],
            array('controller' => 'profiles', 'action' => 'view', $profile['Profile']['id'])); ?>
        </td>
        <td><?php echo $profile['Profile']['lastname']; ?></td>

        <td>
        	<?php echo $this->Form->postLink(
                'Supprimer',
                array('action' => 'delete', $profile['Profile']['id']),
                array('confirm' => 'Etes-vous sûr ?'));
            ?>
        </td>

        <td><?php echo $profile['Profile']['study_place']; ?></td>
        <td><?php echo $profile['Profile']['work_place']; ?></td>
        <td><?php echo $profile['Profile']['user_place']; ?></td>
        <td><?php echo $profile['Profile']['birthday']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($profile); ?>
</table>