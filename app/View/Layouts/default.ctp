<?php
	$user = $this->Session->read('Auth.User');
	if (!empty($user)) {
		$notifications = $this->element('notifications');
		$options = $this->element('options');
		$menu = $this->element('menu');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?= $this->Html->charset(); ?>
		<?= $this->Html->meta('icon'); ?>
		<?= $this->fetch('meta'); ?>
		<?= $this->Html->css('generic'); ?>
		<?= $this->Html->css('header'); ?>
		<?= $this->fetch('css'); ?>
		<?= $this->Html->script('/js/jquery.js', array('block' => 'requiredScript')); ?>
		<?= $this->Html->script('dynamic_search', array('inline' => false)); ?>
		<?= $this->fetch('requiredScript'); ?>
		<?= $this->fetch('script'); ?>
	</head>
	<body>
		<div id="header">
			<div id="header_title">
				<?= $this->Html->link('<h1>SocialKOD</h1>', '/', array('escape' => false)); ?>
				<?php if ($user) echo $notifications; ?>
		    </div>
			<?php if ($user) : ?>
				<div id="container_search">
					<input type="text" id="ProfileId" placeholder="Chercher des personnes">
					<div id="results_search"></div>
				</div>
		    	<?= $options ?>
        		<?= $menu ?>
	    	<?php endif ?>
		</div>
		<div id="container">
			<div id="content">
				<?= $this->Session->flash(); ?>
				<?= $this->fetch('content'); ?>
			</div>
			<div id="footer" class="hidden">
				<?= $this->element('sql_dump'); ?>
			</div>
		</div>
	</body>
</html>
