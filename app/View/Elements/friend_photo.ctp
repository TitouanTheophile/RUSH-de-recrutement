	<div id="friend_element">
		<div id="friend_element_photo">
			<?php
				if ( isset($my_friend['Friend']['user2_id']) ) {
					$friend_data = $this->requestAction(
						'users/getUser',
						array('pass' => array($my_friend['Friend']['user2_id']))
					);
				}
				else if ( isset($my_friend['Friend']['user1_id']) ) {
					$friend_data = $this->requestAction(
						'users/getUser',
						array('pass' => array($my_friend['Friend']['user1_id']))
					);
				}
				if ( empty($friend_data['User']['picture_id']) || $friend_data['User']['picture_id'] == NULL ) {
					echo $this->Html->link(
				        $this->Html->image('inconnu.jpg', array('alt' => 'Photo de profil')),
				        array('action' => 'view', $friend_data['User']['id']),
				        array('escape' => false)
				    );
				}
				else {
					if ( file_exists(IMAGES.'avatars'.DS.$friend_data['User']['picture_id'].'.jpg') ) {
						echo $this->Html->link(
					        $this->Html->image( 'avatars/' . $friend_data['User']['picture_id'] . '.jpg', array('alt' => 'Photo de profil')),
					       	array('action' => 'view', $friend_data['User']['id']),
					        array('escape' => false)
						);
					}
				}
			?>
		</div>
		<div id="friend_element_name">
			<span>
				<?php
					echo $this->Html->link((
						$friend_data['User']['firstname']." ".$friend_data['User']['lastname']),
		           		array('controller' => 'users', 'action' => 'view', $friend_data['User']['id']));
					if ( isset($my_friend['Friend']['pending']) ) {
						echo " (en attente)";
						$pending = $this->requestAction(
							'users/getPending',
							array('pass' => array($my_friend['Friend']['pending']))
						);
						if ( $pending == 1 ) {
							echo $this->Form->postLink(
								'<br />[Accepter invitation]',
								array('controller' => 'friends', 'action' => 'acceptFriend', $my_friend['Friend']['id']),
								array('escape' => false)
							);
						}
					}
	           	?>
			</span>
		</div>
	</div>