<?= $this->Html->div(null, $this->element('user_photo', array('user' => $owner['User'])), array('id' => 'user_header')); ?>
<?= $this->Html->css('album', array('inline' => false)); ?>
<?= $this->Html->css('users', array('inline' => false)); ?>
<?= $this->Html->div('section_title', "<h3>".$album['Album']['title']."</h3>"); ?>
<?php 
	$nav  = $this->Html->link('Ajouter une image', array('controller' => 'pictures', 'action' => 'add', $album['Album']['id']));
	$nav .= $this->Html->link('Modifier l\'album', array('controller' => 'albums', 'action' => 'editAlbum', $album['Album']['id']));
	$nav .= $this->Html->link('Suprimer l\'album', array('controller' => 'albums', 'action' => 'delAlbum', $album['Album']['id']),
												   array('confirm' => 'Voulez-vous vraiment supprimer cet album et toutes les images qu\'il contient ?'));
	$back = $this->Html->link('Retour', array('controller' => 'albums', 'action' => 'index', $album['Album']['user_id']));
	$nav .= $back;
	if ($album['Album']['user_id'] == $this->Session->read('Auth.User.id'))
		echo $this->Html->div('section_nav', $nav); 
	else
		echo $this->Html->div('section_nav', $back);
?>
<?= $this->Html->div('section_text', $this->Html->para('album_desc', $album['Album']['description'])); ?>
<?php 
	foreach ($pics as $pic) {
		$pic_div = $this->Html->image("/img/" . $pic['Picture']['id']. ".jpg", array('alt' => '', 'url' => array('controller' => 'pictures', 
																												 'action' => 'view', 
																												 $pic['Picture']['id'])));
		$pic_div .= $this->Html->link('Supprimer', array('controller' => 'pictures', 'action' => 'delete', $pic['Picture']['id'], $album['Album']['id']),
												   array('confirm' => 'Voulez-vous vraiment supprimer cette image ?', 'class' => 'del_cross'));
		$pic_div .= $this->Html->para('pic_desc', $pic['Picture']['description']);
		echo $this->Html->div('pic', $pic_div);
	}
?>