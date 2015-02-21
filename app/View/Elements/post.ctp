<div class="content_wall">
	<div class="content_wall_header">
		<?php
			$user = $this->requestAction('users/getUser', array('pass' => array($content['Content']['from_id'])));
			$target = $this->requestAction(($content['Content']['targetType_id'] == 1 ? 'users/getUser' : 'groups/getGroup'),
											array('pass' => array($content['Content']['target_id'])));
			$user_picture = (!file_exists(IMAGES.'avatars/'.$user['User']['id'].'.jpg') ?
							   'inconnu.jpg' : 'avatars/'.$user['User']['id'].'.jpg');
			$user_picture = $this->Html->link($this->Html->image($user_picture, array('alt' => 'Photo de profil')),
				        						array('action' => 'view', $user['User']['id']),
				        						array('escape' => false, 'class' => 'content_wall_header_pic'));
			$header  = $this->Html->link($user['User']['firstname']." ".$user['User']['lastname'],
           							   	 array('controller' => 'users', 'action' => 'view', $user['User']['id']));
			$header .= ' a publié le ';
			$header .= $this->Time->format($content['Content']['created'], '%#d/%m/%y') . ' à ';
			$header .= $this->Time->format($content['Content']['created'], '%H:%M');
			if ($content['Content']['targetType_id'] == 1 && $user['User']['id'] != $target['User']['id']) {
				$header .= ' envoyé à ';
				$header .= $this->Html->link($target['User']['firstname']." ".$target['User']['lastname'],
           							   	 	 array('controller' => 'users', 'action' => 'view', $target['User']['id']));
           	}
           	else if ($content['Content']['targetType_id'] == 2) {
           		$header .= ' a publié sur ';
				$header .= $this->Html->link($target['Group']['name'],
           							   	 	 array('controller' => 'groups', 'action' => 'view', $target['Group']['id']));
           	}
			echo $user_picture . $this->Html->tag('span', $header);
		?>
	</div>
		<?php 
			if ($this->Session->read('Auth.User.id') == $user['User']['id'])
				echo $this->Form->postLink($this->Html->image('cross.png', array('alt' => 'Supprimer le post', 'class' => 'post_delete')),
              						  	   array('controller' => 'users', 'action' => 'deletePost', $content['Content']['id']),
              						  	   array('escape' => false, 'confirm' => 'Êtes-vous sûr ?'));
          ?>
	<p>
		<?= $post_content; ?>
	</p>
	<div class="post_comment">
		<?php
			$comment = $this->requestAction(
				'users/getComment',
				array('pass' => array($content['Content']['id']))
			);
		?>
		<?php echo $this->element('comment', array('content' => $content, 'comment' => $comment));
	    ?>
	</div>
</div>