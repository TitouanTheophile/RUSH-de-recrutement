<div class='points'>
<?php $points = $this->requestAction("contents/getPoints/$id"); ?>
	<div class="like_div">
		<?php $action = (!empty($points['Points'][0]) && $points['Points'][0]['pointType'] == 1 ? 'removePoint' : 'addPoint'); ?>
		<p class="likeP"><?= count($points['LikeP']) ?></p>
		<?= $this->Html->link('Like', array('controller' => 'contents', 'action' => $action, $points['Content']['id'], 1),
									  array('class' => ($action == 'removePoint' ? array('like_logo', 'active') : 'like_logo'))); ?>
	</div>
	<div class="connard_div">
		<?php $action = (!empty($points['Points'][0]) && $points['Points'][0]['pointType'] == 2 ? 'removePoint' : 'addPoint'); ?>
		<?= $this->Html->link('Like', array('controller' => 'contents', 'action' => $action, $points['Content']['id'], 2),
									  array('class' => ($action == 'removePoint' ? array('connard_logo', 'active') : 'connard_logo'))); ?>
		<p class="connardP"><?= count($points['ConnardP']) ?></p>
	</div>
</div>
