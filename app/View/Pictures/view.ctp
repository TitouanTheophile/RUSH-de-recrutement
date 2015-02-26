<?= $this->Html->css('album', array('inline' => false)) ?>
<h3 class="section_title"><?= $album['Album']['title'] ?></h3>
<div class="section_nav">
	<?php 
		$nav  = $this->Html->link('Ajouter une image',  array('controller' => 'pictures', 'action' => 'add', $album['Album']['id']));
		$nav .= $this->Html->link('Modifier',  array('controller' => 'pictures', 'action' => 'edit', $pic['Picture']['id'], $album['Album']['id']));
		$nav .= $this->Html->link('Supprimer', array('controller' => 'pictures', 'action' => 'delete', $pic['Picture']['id'], $album['Album']['id']),
									   		   array('confirm' => 'Voulez-vous vraiment supprimer cette image ?'));
		$back = $this->Html->link('Retour à l\'album', array('controller' => 'albums', 'action' => 'album', $album['Album']['id']));
		$nav .= $back;
		echo (($album['Album']['user_id'] == $this->Session->read('Auth.User.id')) ? $nav : $back);
	?>
</div>
<div class="big_pic">
	<?php
		$previous = $this->Html->div('previous_button', $this->Html->para(null, '<'));
		$big_pic  = $this->Html->link($previous, array('controller' => 'pictures', 'action' => 'previous', $pic['Picture']['id']),
												 array('escape' => false));
		$big_pic .= $this->Html->image('/img/'. $pic['Picture']['id'] .'.jpg', array('alt' => '', 'url' => array('controller' => 'pictures', 
																		 			  				 			 'action' => 'next', 
																		 			  				 			 $pic['Picture']['id'])));
		$next = $this->Html->div('next_button', $this->Html->para(null, '>'));
		$big_pic .= $this->Html->link($next, array('controller' => 'pictures', 'action' => 'next', $pic['Picture']['id']),
											 array('escape' => false));
		$action = (!empty($userPoint) && $userPoint['ContentP']['pointType'] == 1 ? 'removePoint' : 'addPoint');
		$like  = $this->Html->para('likeP', $likeP);
		$like .= $this->Html->link('Like', array('controller' => 'pictures', 'action' => $action, $pic['Picture']['id'], 1),
										   array('class' => ($action == 'removePoint' ? array('like_logo', 'active') : 'like_logo')));
		$action = (!empty($userPoint) && $userPoint['ContentP']['pointType'] == 2 ? 'removePoint' : 'addPoint');
		$big_pic .= $this->Html->div('like_div', $like);
		$connard  = $this->Html->para('connardP', $connardP);
		$connard .= $this->Html->link('Connard', array('controller' => 'pictures', 'action' => $action,	$pic['Picture']['id'], 2),
											  	 array('class' => ($action == 'removePoint' ? array('connard_logo', 'active') : 'connard_logo')));
		$big_pic .= $this->Html->div('connard_div', $connard);
		echo $big_pic;
	?>
</div>
<p class="desc"><?= htmlentities($pic['Picture']['description']); ?></p>