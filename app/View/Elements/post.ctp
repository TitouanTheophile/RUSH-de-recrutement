<?php foreach ($posts as $post): ?>

<div class="content_wall">
	<div class="content_wall_header">
	<?php
	$post_sender_pic  = $this->element('user_pic', array('id' => $post['from_usr']['id'],
									   'url' => array('controller' => 'users', 'action' => 'view', $post['from_usr']['id']),
									   'class' => 'comment_header_pic'));		
	$post_profil_info =	$this->Html->link($post['from_usr']['firstname']." ".$post['from_usr']['lastname'],
          						   		  array('controller' => 'users', 'action' => 'view', $post['from_usr']['id']));
	if ($post['from_usr']['id'] != $post['target']['id'])
	$post_profil_info .= $this->Html->image('publicationArrow', array('alt' => 'publicationArrow', 'class' => 'publicationArrow')) .
				 		$this->Html->link($post['target']['firstname']." ".$post['target']['lastname'],
		          		array('controller' => 'users', 'action' => 'view', $post['target']['id']));
	$post_date = "Le ".
				 $this->Time->format($post['Content']['created'], '%#d/%m/%y') .
				 ' à '.
				 $this->Time->format($post['Content']['created'], '%H:%M');
	echo $post_sender_pic.
		 $post_profil_info.
		 "<br />".
		 $this->html->tag('span', $post_date, array('class' => 'post_date'));
	if ($this->Session->read('Auth.User.id') == $user['User']['id'])
		echo $this->Form->postLink($this->Html->image('cross.png', array('alt' => 'Supprimer le post', 'class' => 'post_delete')),
      						  	   array('controller' => 'users', 'action' => 'deletePost', $post['Content']['id']),
      						  	   array('escape' => false, 'confirm' => 'Êtes-vous sûr ?'));
?>
	</div>
	<?php
		$pic = "";
		if ($post['picture']['id'] != null)
			$pic = $this->Html->image($post['picture']['id'], array('alt' => 'posted_picture','class' => 'posted_picture'));
		echo $this->html->tag('div', "<span>" . $post['post']['content'] . "</span>" . $pic, array('class' => 'post_content'));
	?>
	<div class="post_comment" value="toto">
		<?php
			$comment = $this->requestAction(
				'comments/getComment/' . $post['Content']['id'] . "/false"
			);
		//$comment = htmlspecialchars_decode($comment, ENT_QUOTES);
		?>
		<?php echo $this->element('comment', array('id' => $post['Content']['id'], 'comment' => $comment));
	    ?>
	</div>
</div>
<?php endforeach ?>