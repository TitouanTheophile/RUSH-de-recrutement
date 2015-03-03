<?= $this->Html->css('score', array('inline' => false)); ?>
<div class="score_container">
	<h4>Classements des points</h4>
		<table>
			<thead>
				<tr><td>#</td><td>Score</td><td>Profil</td></tr>
			</thead>
			<?php $i = 0 ?>
			<?php foreach ($users_points as $user => $point): ?>
				<tr>
					<td><?= ++$i ?></td>
					<td><span class='score'><?= $point ?></span></td>
					<td><div class="score_user"><?= $this->element('user_photo', array('user' => $list_user[$user]));?></div></td>
				</tr>
			<?php endforeach ?>
		</table>
</div>