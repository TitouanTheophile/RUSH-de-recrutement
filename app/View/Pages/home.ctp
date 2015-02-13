<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */
	$this->layout = 'default_visitor';
?>

<div id="home">
	<?php echo $this->Html->link(
		'<div class="home_box">' .
		'<div class="home_box_inner">' .
			$this->Html->image('signup.png', array('alt' => "S'incrire")) .
			"<span>S'incrire</span>" .
		'</div></div>',
        array('controller' => 'users', 'action' => 'signup'),
        array('escape' => false));
    ?><!--
	--><?php echo $this->Html->link(
		'<div class="home_box">' .
		'<div class="home_box_inner">' .
			$this->Html->image('signin.png', array('alt' => "Se connecter")) .
			"<span>Se connecter</span>" .
		'</div></div>',
        array('controller' => 'users', 'action' => 'login'),
        array('escape' => false));
    ?>
    <div id="home_comment">
    	<span>Bienvenue sur SocialKOD, le MEILLEUR des reseaux sociaux en ligne ewe</span>
   	</div>
</div>