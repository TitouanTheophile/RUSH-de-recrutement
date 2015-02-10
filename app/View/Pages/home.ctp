<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */
?>

<div id="home">
	<?php echo $this->Html->link(
		'<div class="home_box">' .
		'<div class="home_box_inner">' .
			$this->Html->image('signup.png', array('alt' => "S'incrire")) .
			"<span>S'incrire</span>" .
		'</div></div>',
        array('controller' => 'profiles', 'action' => 'signup'),
        array('escape' => false));
    ?><!--
	--><?php echo $this->Html->link(
		'<div class="home_box">' .
		'<div class="home_box_inner">' .
			$this->Html->image('signin.png', array('alt' => "S'enregistrer")) .
			"<span>S'enregistrer</span>" .
		'</div></div>',
        array('controller' => 'profiles', 'action' => 'login'),
        array('escape' => false));
    ?>
    <div id="home_comment">
    	<span>Bienvenue sur SocialKOD, le MEILLEUR des reseaux sociaux en ligne ewe</span>
   	</div>
</div>