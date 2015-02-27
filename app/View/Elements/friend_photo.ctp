	<div class="friend_element">
		<div class="friend_element_photo">
			<?php
				$friend_id = ($my_friend['Friend']['user2_id'] == $this->Session->read('Auth.User.id') ?
							  $my_friend['Friend']['user1_id'] : $my_friend['Friend']['user2_id']);
				// $friend_id = (isset($my_friend['Friend']['user2_id']) ? $my_friend['Friend']['user2_id'] :
				// 			  (isset($my_friend['Friend']['user1_id']) ? $my_friend['Friend']['user1_id'] : null));
				$friend_data = $this->requestAction('users/getUser',
													array('pass' => array($friend_id)));
				echo $this->element('user_pic', array('id' => $friend_data['User']['id'],
												  	  'url' => array('controller' => 'users', 'action' => 'view', $friend_data['User']['id']),
											 	  	  'class' => ''));
			?>
		</div>
		<div class="friend_element_name">
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
													   				array('controller' => 'friends', 'action' => 'deleteFriend', $friend_id),
													   				array('escape' => false));
							
						}
						else
							$friend_request = $this->Form->postLink('[Annuler]',
													   				array('controller' => 'friends', 'action' => 'deleteFriend', $friend_id),
													   				array('escape' => false));
						echo $this->Html->tag('span', $friend_request, array('class' => 'friendAnswer'));
					}
	           	?>
		</div>
	</div>