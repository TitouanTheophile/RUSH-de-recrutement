<?php
	$user = $this->Session->read('Auth.User');
	if (!empty($user)) {
		$options = $this->element('options');
		$menu = $this->element('menu');
		echo $this->Html->script('dynamic_search', array('inline' => false));
		echo $this->Html->script('dynamic_refresh_notifications', array('inline' => false));
		echo $this->Html->script('notifications_display', array('inline' => false));
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
		<?= $this->fetch('requiredScript'); ?>
		<?= $this->fetch('script'); ?>
	</head>
	<body>
		<div id="header">
			<div id="header_title">
				<?= $this->Html->link('<h1>SocialKOD</h1>', '/', array('escape' => false)); ?>
				<?php if ($user) echo $this->Html->image('logo-notifications.png', array('id' => 'notifications')) . '<div id="notifications_count"></div><div id="notifications_list"></div>' ?>
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
		<input type="hidden"  name="get_notifications" value=<?= '"' . $this->HTML->url(array('controller' => 'notifications', 'action' => 'get_notifications')) . '"';?> >
		<input type="hidden"  name="get_notifications_count" value=<?= '"' . $this->HTML->url(array('controller' => 'notifications', 'action' => 'get_notifications_count')) . '"';?> >
		<input type="hidden"  name="get_users" value=<?= '"' . $this->HTML->url(array('controller' => 'users', 'action' => 'get_users')) . '"';?> >
		<input type="hidden"  name="get_groups" value=<?= '"' . $this->HTML->url(array('controller' => 'groups', 'action' => 'get_groups')) . '"';?> >
	</body>

</html>
