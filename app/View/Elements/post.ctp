<div class="content_wall">

	<div class="content_wall_header">
		<?php

			$user = $this->requestAction(
				'users/getFrom',
				array('pass' => array($content['Content']['from_id']))
			);
			$target = $this->requestAction(
				'users/getTarget',
				array('pass' => array($content['Content']['target_id']))
			);

			if ( empty($user['User']['picture_id']) || $user['User']['picture_id'] == NULL ) {
				echo $this->Html->link(
			        $this->Html->image('inconnu.jpg', array('alt' => 'Photo de profil', 'title' => 'Changer ma photo de profil')),
			        array('action' => 'view', $user['User']['id']),
			        array('escape' => false)
			    );
			}
			else {
				echo $this->Html->link(
			        $this->Html->image( $user['User']['picture_id'] . '.jpg', array('alt' => 'Photo de profil', 'title' => 'Changer ma photo de profil')),
			        array('action' => 'view', $user['User']['id']),
			        array('escape' => false)
			    );
			}
		?>
		<span>
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
           	?>
		</span>
	</div>

	<p>
		<?php echo $post_content; ?>
	</p>
	<div class="post_comment">
		<?php echo $this->element('comment', array('content' => $content));
        ?>
	</div>

</div>