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
					if (empty($content['User_target']['firstname']))
						{
							echo ' → ' . $this->Html->link(
								$content['Group']['name'],
								array('controller' => 'users', 'action' => 'view', $content['User_target']['id'])
							);
						}
					else
						{
							echo ' → ' . $this->Html->link(
								$content['User_target']['firstname'] . ' ' . $content['User_target']['lastname'],
								array('controller' => 'users', 'action' => 'view', $content['User_target']['id'])
							);
						}
				}
			echo $this->Html->tag(
				'span',
				'Le ' . $this->Time->format($content['Content']['created'], '%#d/%m/%y') . ' à ' . $this->Time->format($content['Content']['created'], '%H:%M'),
				array('class' => 'post_date')
			);
			if ($this->Session->read('Auth.User.id') == $content['User_from']['id'] ||
					(isset($user['User']['id']) && $this->Session->read('Auth.User.id') == $user['User']['id']))
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
				{
					echo $this->Video->embed($content['Post']['content'], array('width' => 450, 'height' => 300));
					echo $this->Html->tag(
						'span',
						$content['Post']['content'],
						array('class' => 'content_text')
					);
				}
			else
				{
					echo $this->Html->link(
						$this->Html->image($content['Picture']['id'], array('alt' => 'posted_picture','class' => 'posted_picture')),
						array('controller' => 'pictures', 'action' => 'view', $content['Picture']['id']),
						array('escape' => false)
					);

					if (!empty($content['Picture']['description']))
						{
							echo $this->Html->tag(
								'span',
								$content['Picture']['description'],
								array('class' => 'content_text')
							);
						}
				}
			echo $this->element('points', array('id' => $content['Content']['id']));
		?>
	</div>
	<div class="post_comment" value="toto">
		<?php
			$comment = $this->requestAction('comments/getComment/' . $content['Content']['id'] . "/false");
			echo $this->element('comment', array('id' => $content['Content']['id'], 'comment' => $comment));
		?>
	</div>
</div>