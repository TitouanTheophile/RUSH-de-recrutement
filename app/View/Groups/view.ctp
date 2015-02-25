<?= $this->Html->css('users', array('inline' => false)); ?>
<?= $this->Html->css('content', array('inline' => false)); ?>
<?= $this->Html->css('friend', array('inline' => false)); ?>
<?= $this->Html->css('comment', array('inline' => false)); ?>
<?php
$ismember = 0;
foreach ($group['User'] as $user) { // Check if user is in the group
	if ($this->Session->read('Auth.User.id') == $user['id'] && $user['GroupsUser']['group_id'] == $group['Group']['id'])
		$ismember = 1;
}
?>
<div id="user_header">
	<div id="user_element">
		<div id="user_element_name">
			<?= $this->Html->link($group['Group']['name'], array('controller' => 'groups', 'action' => 'view', $group['Group']['id'])); ?>
		</div>
	</div>
	<div id="friend_box">
		<?php
			if ($ismember == 1)
				echo $this->Form->postLink('Quitter le groupe', array('action' => 'leave', $group['Group']['id']),
														array('confirm' => 'Etes-vous sûr ?'));
			else if ($ismember == 0)
				echo $this->Form->postLink('Rejoindre le groupe', array('action' => 'join', $group['Group']['id']));
		?>
	</div>
</div>

<div id="wall_infos" class="container_padding">
	<div class="container_padding wall_infos_section">
		<h4>Infos publiques</h4>
	</div>
	<div class="container_padding">
		<?= "<p>Créé depuis le <strong>" . $this->Time->format($group['Group']['created'], '%e %B %Y') . "</strong></p>"; ?>
	</div>
	<div class="container_padding">
		<?= $this->Html->link($this->Html->image('friends.png', array('alt' => "Liste d'amis"))."<span>Liste des membres</span>",
               	array('controller' => 'groups', 'action' => 'members', $group['Group']['id']),
               	array('escape' => false, 'id' => 'wall_infos_friend')); ?>
	</div>
</div>

<div id="user_wall" class="container_padding">
	<h4>Actulaité</h4>
	<hr />
	<div class="container_padding">
	<?php
		if (!$ismember)
			echo "Vous devez être dans le groupe <strong>" . $group['Group']['name'] . "</strong> pour suivre son activite ou publier sur son mur.";
		else {
			echo $this->Html->link('Publier un post',
				array ('action' => 'sendPost', $group['Group']['id']));
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
		}
	?>
	</div>
</div>