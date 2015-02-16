<?= $this->element('profile_photo'); ?>
<?= $this->Html->css('album', array('inline' => false)); ?>
<?= $this->Html->div('section_title', "<h3>$title</h3>"); ?>
<?php 
	$nav  = $this->Html->link('Ajouter une image', array('controller' => 'pictures', 'action' => 'add', $album));
	$nav .= $this->Html->link('Modifier l\'album', array('controller' => 'albums', 'action' => 'editAlbum', $album));
	$nav .= $this->Html->link('Suprimer l\'album', array('controller' => 'albums', 'action' => 'delAlbum', $album),
												   array('confirm' => 'Voulez-vous vraiment supprimer cet album et toutes les images qu\'il contient ?'));
	$nav .= $this->Html->link('Retour', array('controller' => 'albums', 'action' => 'index'));
?>
<?= $this->Html->div('section_nav', $nav); ?>
<?= $this->Html->div('section_text', $this->Html->para('album_desc', $description)); ?>
<?php 
	foreach ($pics as $pic) {
		$pic_div = $this->Html->image("/img/" . $pic['Picture']['id']. ".jpg", array('alt' => '', 'url' => array('controller' => 'pictures', 
																												 'action' => 'view', 
																												 $pic['Picture']['id'])));
		$pic_div .= $this->Html->link('Supprimer', array('controller' => 'pictures', 'action' => 'delete', $pic['Picture']['id'], $album),
												   array('confirm' => 'Voulez-vous vraiment supprimer cette image ?', 'class' => 'del_cross'));
		$pic_div .= $this->Html->para('pic_desc', $pic['Picture']['description']);
		echo $this->Html->div('pic', $pic_div);
	}
?>