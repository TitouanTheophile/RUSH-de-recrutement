	<div id="friend_element">
		<div id="friend_element_photo">
			<?php
				$friend_id = (isset($my_friend['Friend']['user2_id']) ? $my_friend['Friend']['user2_id'] :
							  (isset($my_friend['Friend']['user1_id']) ? $my_friend['Friend']['user1_id'] : null));
				$friend_data = $this->requestAction('users/getUser',
													array('pass' => array($friend_id)));
				$friend_picture = (!file_exists(IMAGES.'avatars'.DS.$friend_data['User']['id'].'.jpg') ?
								   'inconnu.jpg' : 'avatars'.DS. $friend_data['User']['id'] . '.jpg');
				$scale = getimagesize(IMAGES . DS. $friend_picture);
				$scale = ($scale[0] >= $scale[1] ? 'large' : 'long');
				$friend_picture = $this->Html->link($this->Html->image($friend_picture, array('alt' => 'Photo de profil', 'class' => $scale)),
				        							array('action' => 'view', $friend_data['User']['id']),
				        							array('escape' => false));
				echo $friend_picture;
				if (!isset($my_friend['Friend']['pending'])) {
					debug("here");
				}
			?>
		</div>
		<div id="friend_element_name">
				<?php
					echo $this->Html->link($friend_data['User']['firstname']." ".$friend_data['User']['lastname'],
		           						   array('controller' => 'users', 'action' => 'view', $friend_data['User']['id']));
					if (isset($my_friend['Friend']['pending'])) {
						echo "(en attente)";
						if ($my_friend['Friend']['pending'] == $this->Session->read('Auth.User.id')) {
							$friend_request = $this->Form->postLink('[Accepter]',
																	array('controller' => 'friends', 'action' => 'acceptFriend', $my_friend['Friend']['id']),
													   				array('escape' => false));
							$friend_request .= $this->Form->postLink('[Refuser]',
													   				array('controller' => 'friends', 'action' => 'deleteFriend', $my_friend['Friend']['id']),
													   				array('escape' => false));
							
						}
						else
							$friend_request = $this->Form->postLink('[Annuler]',
													   				array('controller' => 'friends', 'action' => 'deleteFriend', $my_friend['Friend']['id']),
													   				array('escape' => false));
						echo $this->Html->tag('span', $friend_request, array('class' => 'friendAnswer'));
					}
	           	?>
		</div>
	</div>