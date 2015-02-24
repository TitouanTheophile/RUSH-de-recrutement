<?php 
	$picture = (!file_exists(IMAGES . 'avatars' . DS . "$id.jpg") ?
				'inconnu.jpg' : 'avatars'. DS . "$id.jpg");
	$scale = getimagesize(IMAGES . DS . $picture);
	$scale = ($scale[0] >= $scale[1] ? 'large' : 'long');
	$picture = $this->Html->link($this->Html->image($picture, array('alt' => 'Photo de profil', 'class' => $scale)),
	        					 $url, array('escape' => false, 'class' => $class));
	echo $picture;
?>