<?= debug($content); ?>
<div class="content_wall">
	<div class="content_wall_header">
		<?php
			echo $this->element('user_pic', array(
				'id' => $content['User_from']['id'],
				'url' => array('controller' => 'users', 'action' => 'view', $content['User_from']['id']),
				'class' => 'comment_header_pic'
				)
			);
			echo $this->Html->link(
				$content['User_from']['firstname'] . ' ' . $content['User_from']['lastname'],
				array('controller' => 'users', 'action' => 'view', $content['User_from']['id'])
			);
			if (isset($content['User_target']) && $content['User_from']['id'] != $content['User_target']['id'])
				{
					echo ' → ' . $this->Html->link(
						$content['User_target']['firstname'] . ' ' . $content['User_target']['lastname'],
						array('controller' => 'users', 'action' => 'view', $content['User_target']['id'])
					);
				}
			echo $this->Html->tag(
				'span',
				'Le ' . $this->Time->format($content['Content']['created'], '%#d/%m/%y') . ' à ' . $this->Time->format($content['Content']['created'], '%H:%M'),
				array('class' => 'post_date')
			);
			if ($this->Session->read('Auth.User.id') == $content['User_from']['id'] || $this->Session->read('Auth.User.id') == $user['User']['id'])
				{
					echo $this->Html->link(
						$this->Html->image('cross.png', array('alt' => 'Supprimer le post', 'class' => 'post_delete')),
						array('controller' => 'users', 'action' => 'deletePost', $content['Content']['id']),
						array('escape' => false, 'confirm' => 'Êtes-vous sûr ?')
					);
				}
		?>
	</div>
	<div class="post_content">
		<?php 
			if ($content['Content']['contentType_id'] == 1)
				echo $this->Video->embed($content['Post']['content'], array('width' => 450, 'height' => 300));
			else
				echo $this->Html->image($content['Picture']['id'], array('alt' => 'posted_picture','class' => 'posted_picture'));
			echo $this->Html->tag(
				'span',
				$content['Post']['content'],
				array('class' => 'content_text')
			);
		?>
	</div>
	<div class="post_comment" value="toto">
		<?php
			$comment = $this->requestAction('comments/getComment/' . $content['Content']['id'] . "/false");
			echo $this->element('comment', array('id' => $content['Content']['id'], 'comment' => $comment));
		?>
	</div>
</div>