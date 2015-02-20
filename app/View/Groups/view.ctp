<?= $this->Html->css('content', array('inline' => false)); ?>
<?= '<h1>' .$group['Group']['name'] . '</h1>'?>
<?php
foreach ($group['User'] as $user) { // Check if user is in the group
	$ismember = 0;
	if ($this->Session->read('Auth.User.id') == $user['id'] && $user['GroupsUser']['group_id'] == $group['Group']['id'])
		$ismember = 1;
}
?>
<?php if (!$ismember): ?>
You are out! :(

<?php else: ?>
<div id="group_wall" class="container_padding">
	<h4>Actualité</h4>
	<hr />
	<div class="container_padding">
	<?php
		foreach ($contents as $content) {
			if ($content['Content']['targetType_id'] == 2) {
				if ($content['Content']['contentType_id'] == 1) {
					foreach ($posts as $post) {
						if ($content['Content']['content_id'] == $post['Post']['id']) {
							echo $this->element(
								'post',
								array (
									'post_content' => $post['Post']['content'],
									'content' => $content
									));
						}
					}
				}
				else {
					foreach ($pictures as $picture) {
						if ($content['content_id'] == $picture['Picture']['id'])
							echo $this->Html->image($picture['Picture']['id'] . '.jpg');
					}
				}
			}
		}
	?>
	</div>
</div>
<?php endif ?>