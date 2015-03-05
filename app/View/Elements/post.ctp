<?php foreach ($posts as $post): ?>

<div class="content_wall">
	<div class="content_wall_header">
	<?php
	$post_sender_pic  = $this->element('user_pic', array('id' => $post['User_from']['id'],
									   'url' => array('controller' => 'users', 'action' => 'view', $post['User_from']['id']),
									   'class' => 'comment_header_pic'));

	$post_profil_info =	$this->Html->link($post['User_from']['firstname']." ".$post['User_from']['lastname'],
          						   		  array('controller' => 'users', 'action' => 'view', $post['User_from']['id']));

	if ($post['User_from']['id'] != $post['User_target']['id'])
	$post_profil_info .= $this->Html->image('publicationArrow', array('alt' => 'publicationArrow', 'class' => 'publicationArrow')) .
				 		$this->Html->link($post['User_target']['firstname']." ".$post['User_target']['lastname'],
		          		array('controller' => 'users', 'action' => 'view', $post['User_target']['id']));

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
	// if ($this->Session->read('Auth.User.id') == $user['User']['id'])
	// 	echo $this->Form->postLink($this->Html->image('cross.png', array('alt' => 'Supprimer le post', 'class' => 'post_delete')),
	// 										  	   array('controller' => 'users', 'action' => 'deletePost', $content['Content']['id']),
	// 										  	   array('escape' => false, 'confirm' => 'Êtes-vous sûr ?'));
	echo ($this->Video->embed($post['Post']['content'], array(
							 'width' => 450,
							 'height' => 300)
							 ));

	$pic = "";
	if ($post['Picture']['id'] != null)
		$pic = $this->Html->image($post['Picture']['id'], array('alt' => 'posted_picture','class' => 'posted_picture'));
	echo $this->html->tag('div', "<span>" . $post['Post']['content'] . "</span>" . $pic, array('class' => 'post_content'));
?>

	<div class="post_comment" value="toto">

	<?php

		$comment = $this->requestAction(
		'comments/getComment/' . $post['Content']['id'] . "/false"
		);
		//$comment = htmlspecialchars_decode($comment, ENT_QUOTES);
		echo $this->element('comment', array('id' => $post['Content']['id'], 'comment' => $comment));
	?>
	</div>
</div>
<?php endforeach ?>