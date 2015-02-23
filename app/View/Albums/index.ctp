<?= $this->Html->div(null, $this->element('user_photo', array('user' => $user['User'])), array('id' => 'user_header')); ?>
<?= $this->Html->css('album', array('inline' => false)) ?>
<?= $this->Html->css('users', array('inline' => false)); ?>
<?php $friends_verification = $this->requestAction('friends/isFriend', array('pass' => array($this->Session->read('Auth.User.id'), $user['User']['id']))); ?>
<?= $this->Html->div('section_title', "<h3>Albums</h3>") ?>
<?php if ($user['User']['id'] == $this->Session->read('Auth.User.id'))
	echo $this->Html->div('section_nav', $this->Html->link('Créer un album', array('controller' => 'albums', 'action' => 'newAlbum'))); 
?>
<?php $album_list = array(); ?>
<?php foreach ($albums as $album) {
	$element = substr($this->Html->link($album['Album']['title'], array('controller' => 'albums',
        																'action' => 'album',
        																$album['Album']['id'])), 0, -4);
	$miniatures_list = array();
	array_push($miniatures_list, $this->Html->image((isset($album['Picture'][0]) ? "/img/" . $album['Picture'][0]['id'] : "/img/no-img.jpg"),
													array('class' => 'miniature')));
	array_push($miniatures_list, $this->Html->image((isset($album['Picture'][1]) ? "/img/" . $album['Picture'][1]['id'] : "/img/no-img.jpg"),
													array('class' => 'miniature')));
	array_push($miniatures_list, $this->Html->image((isset($album['Picture'][2]) ? "/img/" . $album['Picture'][2]['id'] : "/img/no-img.jpg"),
													array('class' => 'miniature')));
	array_push($miniatures_list, $this->Html->image((isset($album['Picture'][3]) ? "/img/" . $album['Picture'][3]['id'] : "/img/no-img.jpg"),
													array('class' => 'miniature')));
	$miniatures_list = $this->Html->nestedList($miniatures_list, array('class' => 'mini_ul'), array('class' => 'mini_li'), "ul");
	$element .= $miniatures_list;
	$element .= $this->Html->para('album_desc', '"' . $album['Album']['description'] . '"');
	$element .= "</a>";
	array_push($album_list, $element);
} ?>
<?= $this->Html->nestedList($album_list, array('class' => 'album_ul'), array('class' => 'album_li'), "ul") ?>