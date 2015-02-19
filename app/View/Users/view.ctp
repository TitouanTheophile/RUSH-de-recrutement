<?= $this->Html->css('users', array('inline' => false)); ?>
<?= $this->Html->css('content', array('inline' => false)); ?>
<?= $this->Html->css('friend', array('inline' => false)); ?>
<div id="user_header">
	<?= $this->element('user_photo', array('user' => $user['User']));?>
	<?php if ($this->Session->read('Auth.User.id') != $user['User']['id']): ?>
	<div id="friend_box">
		<?php
				$friends_verification = $this->requestAction('friends/isFriend',
															 array('pass' => array($this->Session->read('Auth.User.id'), $user['User']['id'])));
				if ($friends_verification == 1)
					echo $this->Form->postLink('Supprimer', array('controller' => 'friends', 'action' => 'deleteFriend', $user['User']['id']),
															array('confirm' => 'Etes-vous sûr ?'));
				else if ( $friends_verification == 0 )
					echo "En attente d'amitié <3";
				else if ( $friends_verification == -1 )
					echo $this->Form->postLink('Ajouter', array('controller' => 'friends', 'action' => 'addFriend', $user['User']['id']));
		?>
	</div>
	<?php else: $friends_verification = 1; ?>
	<?php endif ?>
</div>

<div id="wall_infos" class="container_padding">
		<div class="container_padding wall_infos_section">
			<h4>Infos publiques</h4>
			<?php if ($this->Session->read('Auth.User.id') == $user['User']['id']) : ?>
				<?= $this->Html->tag('span', $this->Html->link('Éditer', array ('action' => 'editInfo', $this->Session->read('Auth.User.id')))); ?>
            <?php endif ?>
		</div>
		<div class="container_padding">
			<?php
				if (!empty($user['User']['gender']) && $friends_verification == 1) {
					echo "<p>Sexe : <strong>";
					echo ($user['User']['gender'] == 1 ? "Masculin" : ($user['User']['gender'] == 2 ? "Feminin" : "Hermaphrodite"));
					echo "</strong></p>";
				}
				if (!empty($user['User']['study_place']) && $friends_verification == 1)
					echo "<p>Étudie à <strong>" . $user['User']['study_place'] . "</strong></p>";
				if (!empty($user['User']['work_place']) && $friends_verification == 1)
					echo "<p>Travaille à <strong>" . $user['User']['work_place'] . "</strong></p>";
				if (!empty($user['User']['user_place']) && $friends_verification == 1)
					echo "<p>Habite à <strong>" . $user['User']['user_place'] . "</strong></p>";
				if (!empty($user['User']['birthday']) && $friends_verification == 1)
					echo "<p>Date de naissance : <strong>" . $this->Time->format($user['User']['birthday'], '%e %B %Y') . "</strong></p>";
				if (!empty($user['User']['created']))
					echo "<p>Inscrit depuis le <strong>" . $this->Time->format($user['User']['created'], '%e %B %Y') . "</strong></p>";
			?>
		</div>
		<div class="container_padding wall_infos_section">
			<h4>Cordonnées</h4>
			<?php if ($this->Session->read('Auth.User.id') == $user['User']['id']) : ?>
				<?= $this->Html->tag('span', $this->Html->link('Éditer', array ('action' => 'editData', $this->Session->read('Auth.User.id')))); ?>
            <?php endif ?>
		</div>
		<div class="container_padding">
			<?php if ($friends_verification == 1) : ?>
				<p>Mon email : <strong><?= $user['User']['email'] ?></strong></p>
				<?= $this->Html->link($this->Html->image('friends.png', array('alt' => "Liste d'amis"))."<span>Liste d'amis</span>",
                		array('controller' => 'users', 'action' => 'friends', $user['User']['id']),
                		array('escape' => false, 'id' => 'wall_infos_friend')); ?>
			<?php endif ?>
		</div>
	</div>
	<div id="user_wall" class="container_padding">
		<h3>Mon actualité</h3>
		<div class="container_padding">
			<?php
				if ( $user['User']['id'] == $this->Session->read('Auth.User.id') || $friends_verification == 1 ) {
					echo $this->Html->link('Publier un post',
                		array ('action' => 'sendPost', $user['User']['id']));
		    		$index = count($contents);
		    		while($index) {
		    			$content = $contents[--$index];
			    		foreach ($posts as $post) {
			    			if ( $post['Post']['id'] == $content['Content']['content_id'] ) {
								echo $this->element(
									'post',
									array (
										'post_content' => $post['Post']['content'],
										'content' => $content
									)
								);
							}
			    		}
			    		unset($post);
			    	}
			    }
			    else {
			    	echo "Vous devez etre ami avec <strong>" . $user['User']['firstname'] . " " . $user['User']['lastname'] . "</strong> pour suivre son activite ou publier sur son mur.";
			    }
	    	?>
		</div>
	</div>
