<?= $this->Html->css('album', array('inline' => false)); ?>
<?= $this->Html->css('users', array('inline' => false)); ?>
<div id="user_header">
	<?= $this->element('user_photo', array('user' => $owner['User'])); ?>
</div>
<h3 class="section_title"><?= $album['Album']['title'] ?></h3>
<div class="section_nav">
	<?php 
		$nav  = $this->Html->link('Ajouter une image', array('controller' => 'pictures', 'action' => 'add', $album['Album']['id']));
		$nav .= $this->Html->link('Modifier l\'album', array('controller' => 'albums', 'action' => 'editAlbum', $album['Album']['id']));
		$nav .= $this->Html->link('Suprimer l\'album', array('controller' => 'albums', 'action' => 'delAlbum', $album['Album']['id']),
													   array('confirm' => 'Voulez-vous vraiment supprimer cet album et toutes les images qu\'il contient ?'));
		$back = $this->Html->link('Retour', array('controller' => 'albums', 'action' => 'index', $album['Album']['user_id']));
		$nav .= $back;
		echo (($album['Album']['user_id'] == $this->Session->read('Auth.User.id')) ? $nav : $back);
	?>
</div>
<p class="section_text"><?= $album['Album']['description'] ?></p>
<?php foreach ($pics as $pic): ?>
	<div class="pic">
		<?php
			$pic_div = $this->Html->image("/img/" . $pic['Picture']['id']. ".jpg", array('alt' => '', 'url' => array('controller' => 'pictures', 
																													 'action' => 'view', 
																													 $pic['Picture']['id'])));
			$pic_div .= $this->Html->link('Supprimer', array('controller' => 'pictures', 'action' => 'delete', $pic['Picture']['id'], $album['Album']['id']),
													   array('confirm' => 'Voulez-vous vraiment supprimer cette image ?', 'class' => 'del_cross'));
			$pic_div .= $this->Html->para('pic_desc', $pic['Picture']['description']);
			echo $pic_div;
		?>
	</div>
<?php endforeach ?>
	