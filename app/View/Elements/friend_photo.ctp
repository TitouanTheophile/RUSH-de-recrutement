	<div class="friend_element">
		<div class="friend_element_photo">
			<?php
				$friend_id = ($my_friend['Friend']['user2_id'] == $requester_id ?
							  $my_friend['Friend']['user1_id'] : $my_friend['Friend']['user2_id']);
				$friend_data = $this->requestAction('users/getUser',
													array('pass' => array($friend_id)));
				echo $this->element('user_pic', array('id' => $friend_data['User']['id'],
												  	  'url' => array('controller' => 'users', 'action' => 'view', $friend_data['User']['id']),
											 	  	  'class' => ''));
			?>
		</div>
		<div class="friend_element_name">
				<?php
					echo $this->Html->link($this->Text->truncate($friend_data['User']['firstname']." ".$friend_data['User']['lastname'], 25),
		           						   array('controller' => 'users', 'action' => 'view', $friend_data['User']['id']),
		           						   array('title' => $friend_data['User']['firstname']." ".$friend_data['User']['lastname']));
					if (isset($my_friend['Friend']['pending'])) {
						echo "(en attente)";
						if ($my_friend['Friend']['pending'] == $requester_id) {
							$friend_request  = $this->Html->link('[Accepter]',
																 array('controller' => 'friends', 'action' => 'acceptFriend', $my_friend['Friend']['id']));
							$friend_request .= $this->Html->link('[Refuser]',
													   			 array('controller' => 'friends', 'action' => 'deleteFriend', $friend_id));
							
						}
						else
							$friend_request = $this->Html->link('[Annuler]',
													   			array('controller' => 'friends', 'action' => 'deleteFriend', $friend_id));
						echo $this->Html->tag('span', $friend_request, array('class' => 'friendAnswer'));
					}
	           	?>
		</div>
	</div>