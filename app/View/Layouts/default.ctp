<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */


$cakeDescription = __d('cake_dev', 'SocialKOD : Le meilleur des reseaux sociaux');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery');
	?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
	<div id="header">
	<div id="header_container">
		<div id="header_title">
			<?php echo $this->Html->link(
				'<h1>SocialKOD</h1>',
	           	'/',
	           	array('escape' => false));
	        ?>
	    </div>
	    <div id="header_option">
	    	<ul>
	    		<?php echo $this->Html->link("<li>Changer ma photo</li>", array('controller' => 'users', 'action' => 'editPhoto', $this->Session->read('Auth.User.id') ), array('escape' => false)); ?>
	    		<?php echo $this->Html->link("<li>Editer mes infos publiques</li>", array('controller' => 'users', 'action' => 'editInfo', $this->Session->read('Auth.User.id') ), array('escape' => false)); ?>
	    		<?php echo $this->Html->link("<li>Editer mes cordonnees</li>", array('controller' => 'users', 'action' => 'editData', $this->Session->read('Auth.User.id') ), array('escape' => false)); ?>
	    		<?php echo $this->Html->link("<li>Deconnexion</li>", array('controller' => 'users', 'action' => 'logout'), array('escape' => false)); ?>
	    	</ul>
        </div>
        <div id="header_menu">
        	<?php
        		if ($this->Session->read('Auth.User')) {
        			//echo "Bienvenue " . $this->Session->read('Auth.User.firstname');
        		}
        		echo $this->Html->link("Mon Profil", array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id') ));
        		echo $this->Html->link("Fil d'actualité", array('controller' => 'users', 'action' => 'news', $this->Session->read('Auth.User.id') ));
        	?>
        </div>
    </div>
	</div>

	<div id="lol"></div>

	<div id="header_spacer"></div>
	<div id="container">
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->element('sql_dump'); ?>
		</div>
	</div>

</body>
</html>
