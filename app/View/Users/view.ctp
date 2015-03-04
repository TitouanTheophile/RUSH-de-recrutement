<?= $this->Html->css('users', array('inline' => false)); ?>
<?= $this->Html->css('content', array('inline' => false)); ?>
<?= $this->Html->css('friend', array('inline' => false)); ?>
<?= $this->Html->css('comment'); ?>
<div id="user_header">
	<?= $this->element('user_photo', array('user' => $user['User']));?>
	<?php if ($this->Session->read('Auth.User.id') != $user['User']['id']): ?>
	<div id="friend_box">
		<?php
				$friends_verification = $this->requestAction('friends/isFriend',
															 array('pass' => array($this->Session->read('Auth.User.id'), $user['User']['id'])));
				if ($friends_verification == 1)
					echo $this->HTML->link('Supprimer', array('controller' => 'friends', 'action' => 'deleteFriend', $user['User']['id']),
															array('confirm' => 'Etes-vous sûr ?'));
				else if ($friends_verification == 0)
					echo "En attentse d'amitié <3";
				else if ($friends_verification == -1)
					echo $this->HTML->link('Ajouter', array('controller' => 'friends', 'action' => 'addFriend', $user['User']['id']));
		?>
	</div>
	<?php else: $friends_verification = 1; ?>
	<?php endif ?>
</div>

<div id="wall_infos" class="container_padding">
		<div class="container_padding wall_infos_section">
			<h4>Infos publiques</h4>
			<?php if ($this->Session->read('Auth.User.id') == $user['User']['id']) : ?>
				<span><?= $this->Html->link('Éditer', array ('action' => 'editInfo', $this->Session->read('Auth.User.id'))); ?></span>
            <?php endif ?>
		</div>
		<div class="container_padding">
			<?php if (!empty($user['User']['gender']) && $friends_verification == 1): ?>
				<p>Sexe : 
					<span class='bold'>
						<?= ($user['User']['gender'] == 1 ? "Masculin" : ($user['User']['gender'] == 2 ? "Feminin" : "Hermaphrodite")) ?>
					</span>			
				</p>
			<?php endif ?>
			<?php if (!empty($user['User']['study_place']) && $friends_verification == 1): ?>
				<p>Étudie à 
					<span class='bold'>
						<?= htmlentities($user['User']['study_place']) ?>
					</span>
				</p>
			<?php endif ?>
			<?php if (!empty($user['User']['work_place']) && $friends_verification == 1): ?>
				<p>Travaille à  
					<span class='bold'>
						<?= htmlentities($user['User']['work_place']) ?>
					</span>
				</p>
			<?php endif ?>
			<?php if (!empty($user['User']['user_place']) && $friends_verification == 1): ?>
				<p>Habite à  
					<span class='bold'>
						<?= htmlentities($user['User']['user_place']) ?>
					</span>
				</p>
			<?php endif ?>
			<?php if (!empty($user['User']['birthday']) && $user['User']['birthday']!= 0 && $friends_verification == 1): ?>
				<p><?= ($user['User']['gender'] == 2 ? 'Née' : 'Né') ?> le :
					<span class='bold'>
						<?= $this->Time->format($user['User']['birthday'], '%e %B %Y') ?>
					</span>
				</p>
			<?php endif ?>
			<?php if (!empty($user['User']['created']) && $user['User']['created']!= 0 ): ?>
				<p><?= ($user['User']['gender'] == 2 ? 'Inscrite' : 'Inscrit') ?> depuis le :
					<span class='bold'>
						<?= $this->Time->format($user['User']['created'], '%e %B %Y') ?>
					</span>
				</p>
			<?php endif ?>
		</div>
		<div class="container_padding wall_infos_section">
			<h4>Cordonnées</h4>
			
		</div>
		<div class="container_padding">
			<?php if ($friends_verification == 1) : ?>
				<p>Mon email : <strong><?= htmlentities($user['User']['email']); ?></strong></p>
				<?= $this->Html->link($this->Html->image('friends.png', array('alt' => "Liste d'array_multisort(arr)"))."<span>Liste d'amis</span>",
                					  array('controller' => 'users', 'action' => 'friends', $user['User']['id']),
                					  array('escape' => false, 'id' => 'wall_infos_friend')); ?>
                <?= $this->Html->link($this->Html->image('albums.png', array('alt' => "Albums photos"))."<span>Albums photos</span>",
                					  array('controller' => 'albums', 'action' => 'index', $user['User']['id']),
                					  array('escape' => false, 'id' => 'wall_infos_albums')); ?>
			<?php endif ?>
		</div>
	</div>
	<div id="user_wall" class="container_padding">
		<h3>Mon actualité</h3>
		<div class="container_padding">
			<?php
				if ($user['User']['id'] == $this->Session->read('Auth.User.id') || $friends_verification == 1)
				{
					
					echo $this->Html->link('Publier un post',
                		array ('action' => 'sendPost', $user['User']['id']));
		    		$contents = $this->requestAction('contents/getContents/'.$user['User']['id']);
					echo $this->element('post', array('posts' => $contents));
			    }
			    else {
			    	echo "Vous devez être ami avec <strong>" . $user['User']['firstname'] . " " . $user['User']['lastname'] . "</strong> pour suivre son activité ou publier sur son mur.";
			    }
	    	?>
		</div>
	</div>
