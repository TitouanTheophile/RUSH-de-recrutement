<?= $this->Html->css('users', array('inline' => false)); ?>
<?= $this->Html->css('content', array('inline' => false)); ?>
<?= $this->Html->css('comment', array('inline' => false)); ?>
<div id="news_profil">
	<div id="user_header">
	<?php
		header('Refresh: 60; URL=');
	 	echo $this->element('user_photo', array('user' => $user['User'])); 
	 ?>
	 </div>
	<div id="wall_infos">
		<div class="container_padding20">
			<h1>Mes groupes</h1>
			<?= $this->Html->link($this->Html->image('plus.png'),
								  array('controller' => 'groups', 'action' => 'create_group'),
								  array('escape' => false, 'class' => 'add_group')); ?>
			<?php
				if (empty($user['Group']))
					echo "Vous n'avez pas de groupe";
				else {
					foreach ($user['Group'] as $group) {
						echo '<div>' . $this->Html->link($group['name'],
		           						   	array('controller' => 'groups', 'action' => 'view', $group['id'])) . '</div>';
					}
				}
			?>
		</div>
	</div>
</div>
<div id="news_wall">
	<div class="container_padding">
		<h4>Fil d'actualite</h4>
		<div class="container_padding">
			<?php if ($user['User']['id'] == $this->Session->read('Auth.User.id') || $friends_verification == 1): ?>
				<?= $this->Html->link('Publier un post', array ('action' => 'sendPost', $user['User']['id'])); ?>
		    <?php 
		    	$contents = $this->requestAction('contents/getContents/'.$user['User']['id']);
		    	foreach ($contents as $content)
		    		echo $this->element('post', array('content' => $content));
		    ?>
			<?php else: ?>
			    <p>"Vous devez être ami avec <span class="bold"><?= $user['User']['firstname'] ?> <?=$user['User']['lastname'] ?></span> pour suivre son activité ou publier sur son mur."</p>
			<?php endif ?>
		</div>
	</div>
</div>