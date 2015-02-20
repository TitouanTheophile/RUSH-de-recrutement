<?= $this->Html->css('album', array('inline' => false)) ?>
<?= $this->Html->div('section_title', "<h3>$title</h3>") ?>
<?php 
	$nav  = $this->Html->link('Ajouter une image',  array('controller' => 'pictures', 'action' => 'add', $album));
	$nav .= $this->Html->link('Modifier',  array('controller' => 'pictures', 'action' => 'edit', $pic['Picture']['id'], $album));
	$nav .= $this->Html->link('Supprimer', array('controller' => 'pictures', 'action' => 'delete', $pic['Picture']['id'], $album),
								   		   array('confirm' => 'Voulez-vous vraiment supprimer cette image ?'));
	$nav .= $this->Html->link('Retour à l\'album', array('controller' => 'albums', 'action' => 'album', $album));
?>
<?= $this->Html->div('section_nav', $nav); ?>
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
?>
<?= $this->Html->div('big_pic', $big_pic); ?>
<?= $this->Html->div('desc', $this->Html->para('pic_desc', $pic['Picture']['description'])); ?>