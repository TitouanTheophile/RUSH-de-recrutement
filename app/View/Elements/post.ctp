<div class="content_wall">
	<div class="content_wall_header">
		<?php
			$from = $this->requestAction('users/getUser', array('pass' => array($content['Content']['from_id'])));
			$target = $this->requestAction('users/getUser', array('pass' => array($content['Content']['target_id'])));
			echo $this->Html->image((empty($from['User']['picture_id']) ? 'inconnu.jpg' : $from['User']['picture_id']),
									  array('alt' => 'Photo de profil',
										    'url' => array('controller' => 'users', 'action' => 'view', $from['User']['id'])));
		?>
		<span>
			<?php
				$name_from = $this->Html->link($from['User']['firstname']." ".$from['User']['lastname'],
           							   		   array('controller' => 'users', 'action' => 'view', $from['User']['id']));
				$name_target = $this->Html->link($target['User']['firstname']." ".$target['User']['lastname'],
           							   			 array('controller' => 'users', 'action' => 'view', $target['User']['id']));
				$post_head = 'publié le ' . $content['Content']['created'];
           		if ($from['User']['id'] != $target['User']['id'])
           			$post_head .= ' envoyé à ' . $this->Html->tag('span', $name_target, array('class' => 'bold'));
				$post_head = $this->Html->div('content_wall_date', $post_head);
           		echo $name_from . $post_head;
           	?>
		</span>
	</div>
	<?= $this->Html->para(null, $post_content); ?>
</div>
