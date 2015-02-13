<div class="content_wall">

	<div class="content_wall_header">
		<?php

			$user = $this->requestAction(
				'users/getFrom',
<<<<<<< HEAD
				array('pass' => array($content['Content']['from_id']))
			);
			$target = $this->requestAction(
				'users/getTarget',
				array('pass' => array($content['Content']['target_id']))
=======
				array('pass' => array($from_id))
>>>>>>> 37be332dfcbecd2c67ffb9775963921760b76f69
			);

			if ( empty($user['User']['picture_id']) || $user['User']['picture_id'] == NULL ) {
				echo $this->Html->link(
			        $this->Html->image('inconnu.jpg', array('alt' => 'Photo de profil', 'title' => 'Changer ma photo de profil')),
<<<<<<< HEAD
			        array('action' => 'view', $user['User']['id']),
=======
			        array('action' => 'editPhoto', $user['User']['id']),
>>>>>>> 37be332dfcbecd2c67ffb9775963921760b76f69
			        array('escape' => false)
			    );
			}
			else {
				echo $this->Html->link(
			        $this->Html->image( $user['User']['picture_id'] . '.jpg', array('alt' => 'Photo de profil', 'title' => 'Changer ma photo de profil')),
<<<<<<< HEAD
			        array('action' => 'view', $user['User']['id']),
=======
			        array('action' => 'editPhoto', $user['User']['id']),
>>>>>>> 37be332dfcbecd2c67ffb9775963921760b76f69
			        array('escape' => false)
			    );
			}
		?>
		<span>
<<<<<<< HEAD
			<?php
				echo $this->Html->link((
					$user['User']['firstname']." ".$user['User']['lastname']),
           			array('controller' => 'users', 'action' => 'view', $user['User']['id'])
           		);
           		echo '<div class="content_wall_date">publié le ' . $content['Content']['created'];
           		if ( $user['User']['id'] != $target['User']['id'] ) {
					echo ' envoyé à <strong>' . $target['User']['firstname'] . '</strong>';
           		}
           		echo '</div>';
=======
			<?php echo $this->Html->link((
				$user['User']['firstname']." ".$user['User']['lastname']),
           		array('controller' => 'users', 'action' => 'view', $user['User']['id']));
>>>>>>> 37be332dfcbecd2c67ffb9775963921760b76f69
           	?>
		</span>
			<?php /*echo $this->Form->postLink(
                'Supprimer',
                array('action' => 'adminDelete', $user['User']['id']),
                array('confirm' => 'Etes-vous sûr ?'));*/
            ?>
	</div>

	<p>
		<?php echo $post_content; ?>
	</p>
	<div class="likes_connards">
		<?php
			echo $this->Html->image('like.png', array('alt' => 'pl', 'title' => 'Trop bien !')) .
			'<span>' . $content['Content']['points_like'] . '</span>';
			echo $this->Html->image('fuck.png', array('alt' => 'pc', 'title' => "Dégage connard !")) .
			'<span>' . $content['Content']['points_connard'] . '</span>';
		?>
	</div>

</div>