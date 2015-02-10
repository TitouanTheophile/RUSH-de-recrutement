	<div id="profile_element">
		<div id="profile_element_photo">
			<?php
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
		</div>
		<div id="profile_element_name">
			<span>
				<?php echo $this->Html->link((
					$profile['Profile']['firstname']." ".$profile['Profile']['lastname']),
	           		array('controller' => 'profiles', 'action' => 'view', $profile['Profile']['id']));
	           	?>
			</span>
		</div>
	</div>