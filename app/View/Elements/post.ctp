<div class="content_wall">

	<div class="content_wall_header">
		<?php

			$profile = $this->requestAction(
				'profiles/getFrom',
				array('pass' => array($from_id))
			);

			if ( empty($profile['Profile']['picture_id']) || $profile['Profile']['picture_id'] == NULL ) {
				echo $this->Html->link(
			        $this->Html->image('inconnu.jpg', array('alt' => 'Photo de profil', 'title' => 'Changer ma photo de profil')),
			        array('action' => 'editPhoto', $profile['Profile']['id']),
			        array('escape' => false)
			    );
			}
			else {
				echo $this->Html->link(
			        $this->Html->image( $profile['Profile']['picture_id'] . '.jpg', array('alt' => 'Photo de profil', 'title' => 'Changer ma photo de profil')),
			        array('action' => 'editPhoto', $profile['Profile']['id']),
			        array('escape' => false)
			    );
			}
		?>
		<span>
			<?php echo $this->Html->link((
				$profile['Profile']['firstname']." ".$profile['Profile']['lastname']),
           		array('controller' => 'profiles', 'action' => 'view', $profile['Profile']['id']));
           	?>
		</span>
	</div>

	<p>
		<?php echo $post_content; ?>
	</p>

</div>