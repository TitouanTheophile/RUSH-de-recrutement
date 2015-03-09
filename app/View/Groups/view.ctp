<?= $this->Html->css('users', array('inline' => false)); ?>
<?= $this->Html->css('content', array('inline' => false)); ?>
<?= $this->Html->css('friend', array('inline' => false)); ?>
<?= $this->Html->css('comment', array('inline' => false)); ?>
<?php
$ismember = 0;
foreach ($members as $member) {
	if ($this->Session->read('Auth.User.id') == $member['GroupsUser']['user_id'])
		$ismember = 1;
}
?>
<div id="user_header">
	<div class="user_element">
		<div class="user_element_name">
			<?= $this->Html->link(
				$Group['name'],
				array('controller' => 'groups', 'action' => 'view', $Group['id'])
			); ?>
		</div>
		<div class="user_element_description">
			<?= htmlentities($Group['description']); ?>
		</div>
	</div>
	<div id="friend_box">
		<?php
			if ($ismember == 1)
				echo $this->HTML->link(
					'Quitter le groupe',
					array('action' => 'leave', $Group['id']),
					array('confirm' => 'Etes-vous sûr ?')
				);
			else if ($ismember == 0)
				echo $this->HTML->link(
					'Rejoindre le groupe',
					array('action' => 'join', $Group['id'])
				);
		?>
	</div>
	<div id="editinfo_box">
		<?php
			if ($ismember == 1)
				echo $this->HTML->link(
					'Editer les informations',
					array('action' => 'edit',$Group['id'])
				);
		?>
	</div>
</div>

<div id="wall_infos" class="container_padding">
	<div class="container_padding wall_infos_section">
		<h4>Infos publiques</h4>
	</div>
	<div class="container_padding">
		<?= "Créé depuis le <strong>" . $this->Time->format($Group['created'], '%e %B %Y') . "</strong>"; ?>
	</div>
	<div class="container_padding">
		<?= $this->Html->link(
				$this->Html->image('friends.png', array('alt' => "Liste d'amis"))."<span>Liste des membres</span>",
               	array('controller' => 'groups', 'action' => 'members', $Group['id']),
               	array('escape' => false, 'id' => 'wall_infos_friend')
            ); ?>
	</div>
</div>

<div id="user_wall" class="container_padding">
	<h4>Actualité</h4>
	<hr />
	<div class="container_padding">
	<?php
		if (!$ismember)
			echo "Vous devez être dans le groupe <strong>" . $group['Group']['name'] . "</strong> pour suivre son activite ou publier sur son mur.";
		else
			{
				echo $this->Html->link(
					'Publier un post',
					array ('action' => 'sendPost', $Group['id'])
				);
				foreach ($contents as $content)
		    		echo $this->element('post', array('content' => $content));
			}
	?>
	</div>
</div> 