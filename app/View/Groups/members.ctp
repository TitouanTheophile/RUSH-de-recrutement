<?= $this->Html->css('friend', array('inline' => false)); ?>
<?= $this->Html->css('users', array('inline' => false)); ?>
<div id="user_header">
	<div id="user_element">
		<div id="user_element_name">
			<?= $this->Html->link($group['Group']['name'], array('controller' => 'groups', 'action' => 'view', $group['Group']['id'])); ?>
		</div>
	</div>
</div>
<div class="user_publication">
	<h4>Liste des membres</h4>
	<?php
		foreach ($members as $member) {
			echo $this->element('member_photo', array("member" => $member));
		}
	?>
</div>