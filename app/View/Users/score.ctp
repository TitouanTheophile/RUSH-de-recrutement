<?= $this->Html->css('score', array('inline' => false)); ?>
<?= $this->Html->script('sorttable', array('inline' => false)); ?>
<div class="score_container">
	<h4>Classements des points</h4>
	<div class="score_podium_container">
		<div class="score_podium_left">
			<?php 
				if (array_slice($users, 1, 1))
					echo $this->element('user_photo', array('user' => array_shift(array_slice($users, 1, 1))));
			?>
			<span>2</span>
		</div>
		<div class="score_podium_top">
			<?php 
				if (array_slice($users, 0, 1))
					echo $this->element('user_photo', array('user' => array_shift(array_slice($users, 0, 1))));
			?>
			<span class="first">1</span>
		</div>
		<div class="score_podium_right">
			<?php 
				if (array_slice($users, 2, 1))
					echo $this->element('user_photo', array('user' => array_shift(array_slice($users, 2, 1))));
			?>
			<span>3</span>
		</div>
	</div>
	<table class='sortable'>
		<thead>
			<tr><td>#</td><td>Score</td><td>Likes</td><td>Connards</td><td>Profil</td></tr>
		</thead>
		<?php $i = 0 ?>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?= ++$i ?></td>
				<td><span class='score'><?= $user['total'] ?></span></td>
				<td><span class='score_likes'><?= (isset($user['likes']) ? $user['likes'] : 0) ?></span></td>
				<td><span class='score_connards'><?= (isset($user['connards']) ? : 0) ?></span></td>
				<td><div class="score_user"><?= $this->element('user_photo', array('user' => $user));?></div></td>
			</tr>
		<?php endforeach ?>
	</table>
</div>