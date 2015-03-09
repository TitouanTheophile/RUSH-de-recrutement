<?= $this->Html->css('album', array('inline' => false)) ?>
<?= $this->Html->css('points', array('inline' => false)) ?>
<h3 class="section_title"><?= $pic['Album']['title'] ?></h3>
<div class="section_nav">
	<?php 
		$nav  = $this->Html->link('Ajouter une image',  array('controller' => 'pictures', 'action' => 'add', $pic['Album']['id']));
		$nav .= $this->Html->link('Modifier',  array('controller' => 'pictures', 'action' => 'edit', $pic['Picture']['id'], $pic['Album']['id']));
		$nav .= $this->Html->link('Supprimer', array('controller' => 'pictures', 'action' => 'delete', $pic['Picture']['id'], $pic['Album']['id']),
									   		   array('confirm' => 'Voulez-vous vraiment supprimer cette image ?'));
		$back = $this->Html->link('Retour à l\'album', array('controller' => 'albums', 'action' => 'album', $pic['Album']['id']));
		$nav .= $back;
		echo (($pic['Album']['user_id'] == $this->Session->read('Auth.User.id')) ? $nav : $back);
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
		$big_pic .= $this->element('points', array('id' => $pic['Content']['id']));
		echo $big_pic;
	?>
</div>
<p class="desc"><?= htmlentities($pic['Picture']['description']); ?></p>