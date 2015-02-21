	<div id="friend_element">
		<div id="friend_element_photo">
			<?php
				$member_picture = (!file_exists(IMAGES.'avatars/'.$member['User']['id'].'.jpg') ? 'inconnu.jpg' : 'avatars/'. $member['User']['id'] . '.jpg');
				$scale = getimagesize(IMAGES . '/'. $member_picture);
				$scale = ($scale[0] >= $scale[1] ? 'large' : 'long');
				$member_picture = $this->Html->link($this->Html->image($member_picture, array('alt' => 'Photo de profil', 'class' => $scale)),
				        							array('action' => 'view', $member['User']['id']),
				        							array('escape' => false));
				echo $member_picture;
			?>
		</div>
		<div id="friend_element_name">
				<?=
					$this->Html->link($member['User']['firstname']." ".$member['User']['lastname'],
		           						   array('controller' => 'users', 'action' => 'view', $member['User']['id']));
		        ?>
		</div>
	</div>