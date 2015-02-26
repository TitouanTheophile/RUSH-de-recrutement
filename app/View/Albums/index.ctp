<?= $this->Html->css('album', array('inline' => false)) ?>
<?= $this->Html->css('users', array('inline' => false)); ?>
<?php $friends_verification = $this->requestAction('friends/isFriend', array('pass' => array($this->Session->read('Auth.User.id'), $user['User']['id']))); ?>
<div id="user_header">
	<?= $this->element('user_photo', array('user' => $user['User'])); ?>
</div>
<h3 class='section_title'>Albums</h3>
<?php if ($user['User']['id'] == $this->Session->read('Auth.User.id')): ?>
	<div class="section_nav">
		<?= $this->Html->link('Créer un album', array('controller' => 'albums', 'action' => 'newAlbum'));  ?>
	</div>
<?php endif ?>
<ul class="album_ul">
	<?php foreach ($albums as $album): ?>
		<li class="album_li">
			<?= substr($this->Html->link($album['Album']['title'], array('controller' => 'albums', 'action' => 'album', $album['Album']['id'])), 0, -4); ?>
			<ul class="mini_ul">
			<?php for ($i = 0; $i < 4; ++$i):?>
				<li class="mini_li">
					<?php 
						$pic = (isset($album['Picture'][$i]) ? $album['Picture'][$i]['id'] . ".jpg" : "no-img.jpg");
						$scale = getimagesize(IMAGES . $pic);
						$scale = ($scale[0] >= $scale[1] ? 'large' : 'long');
						echo $this->Html->image($pic, array('alt' => 'Miniature', 'class' => $scale));
					?>
				</li>
			<?php endfor ?>
			</ul>
			<p class="album_desc">"<?= htmlentities($album['Album']['description']); ?>"</p>
		</li>
	<?php endforeach ?>
</ul>
