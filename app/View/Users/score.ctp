<?= $this->Html->css('score', array('inline' => false)); ?>
<?= $this->Html->script('sorttable', array('inline' => false)); ?>
<div class="score_container">
	<h4>Classements des points</h4>
	<div class="score_podium_container">
		<div class="score_podium_left">
			<?= $this->element('user_photo', array('user' => array_shift(array_slice($list_user, 1, 1)))); ?>
			<span>2</span>
		</div>
		<div class="score_podium_top">
			<?= $this->element('user_photo', array('user' => array_shift(array_slice($list_user, 0, 1)))); ?>
			<span class="first">1</span>
		</div>
		<div class="score_podium_right">
			<?= $this->element('user_photo', array('user' => array_shift(array_slice($list_user, 2, 1)))); ?>
			<span>3</span>
		</div>
	</div>
	<table class='sortable'>
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