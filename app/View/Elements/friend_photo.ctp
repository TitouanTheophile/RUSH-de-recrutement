	<div id="friend_element">
		<div id="friend_element_photo">
			<?php
				$friend_id = (isset($my_friend['Friend']['user2_id']) ? $my_friend['Friend']['user2_id'] :
							  (isset($my_friend['Friend']['user1_id']) ? $my_friend['Friend']['user1_id'] : null));
				$friend_data = $this->requestAction('users/getUser',
													array('pass' => array($friend_id)));
				$friend_picture = (!file_exists(IMAGES.'avatars'.DS.$friend_data['User']['id'].'.jpg') ?
								   'inconnu.jpg' : 'avatars'.DS. $friend_data['User']['id'] . '.jpg');
				$friend_picture = $this->Html->link($this->Html->image($friend_picture, array('alt' => 'Photo de profil')),
				        							array('action' => 'view', $friend_data['User']['id']),
				        							array('escape' => false));
				echo $friend_picture;
			?>
		</div>
		<div id="friend_element_name">
			<span>
				<?php
					echo $this->Html->link($friend_data['User']['firstname']." ".$friend_data['User']['lastname'],
		           						   array('controller' => 'users', 'action' => 'view', $friend_data['User']['id']));
					if (isset($my_friend['Friend']['pending'])) {
						echo " (en attente)";
						$pending = $this->requestAction('users/getPending', array('pass' => array($my_friend['Friend']['pending'])));
						if ($pending == 1) {
							$friend_request = $this->Form->postLink('[Accepter]',
													   				array('controller' => 'friends',
													   					  'action' => 'acceptFriend',
													   					  $my_friend['Friend']['id']),
													   				array('escape' => false));
							$friend_request .= $this->Form->postLink('[Refuser]',
													   				array('controller' => 'friends',
													   					  'action' => 'deleteFriend',
													   					  $my_friend['Friend']['id']),
													   				array('escape' => false));
							echo $this->Html->tag('span', $friend_request, array('class' => 'friendAnswer'));
						}
					}
	           	?>
			</span>
		</div>
	</div>