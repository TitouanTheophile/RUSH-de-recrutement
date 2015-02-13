	<div id="profile_element">
		<div id="profile_element_photo">
			<?php
				if ( empty($user['User']['picture_id']) || $user['User']['picture_id'] == NULL ) {
					echo $this->Html->link(
				        $this->Html->image('inconnu.jpg', array('alt' => 'Photo de profil')),
				        array('action' => 'view', $user['User']['id']),
				        array('escape' => false)
				    );
				}
				else {
					echo $this->Html->link(
				        $this->Html->image( $user['User']['picture_id'] . '.jpg', array('alt' => 'Photo de profil')),
				        array('action' => 'view', $user['User']['id']),
				        array('escape' => false)
				    );
				}
			?>
		</div>
		<div id="profile_element_name">
			<span>
				<?php echo $this->Html->link((
					$user['User']['firstname']." ".$user['User']['lastname']),
	           		array('controller' => 'users', 'action' => 'view', $user['User']['id']));
	           	?>
			</span>
		</div>
	</div>