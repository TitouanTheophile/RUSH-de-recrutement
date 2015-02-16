<?= $this->Html->css('home', array('inline' => false)); ?>
<div id="home">
	<?php
		$link  = $this->Html->image('signup.png', array('alt' => "S'incrire"));
		$link .= $this->Html->tag('span', 'S\'inscrire');
		$link  = $this->Html->div('home_box', $this->Html->div('home_box_inner', $link));
		echo $this->Html->link($link, array('controller' => 'users', 'action' => 'signup'), array('escape' => false));
		$link  = $this->Html->image('signin.png', array('alt' => "Se connecter"));
		$link .= $this->Html->tag('span', 'Se connecter');
		$link  = $this->Html->div('home_box', $this->Html->div('home_box_inner', $link));
    	echo $this->Html->link($link, array('controller' => 'users', 'action' => 'login'), array('escape' => false));
    ?>
    <div id="home_comment">
    	<span>Bienvenue sur SocialKOD, le MEILLEUR des réseaux sociaux en ligne</span>
   	</div>
</div>