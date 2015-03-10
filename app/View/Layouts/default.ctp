<?php
	$user = $this->Session->read('Auth.User');
	if (!empty($user)) {
		$options = $this->element('options');
		$menu = $this->element('menu');
		echo $this->Html->script('search', array('inline' => false));
		echo $this->Html->script('refreshNotifications', array('inline' => false));
		echo $this->Html->script('notificationsDisplay', array('inline' => false));
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
				<?php if ($user): ?>
					<div id='notifications'><span id='header_notif'>✉</span></div>
					<div id="notifications_count"></div>
					<div id="notifications_list"></div>
				<?php endif ?>
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
		<input type="hidden" name="getNotifications" value=<?= '"' . $this->HTML->url(array('controller' => 'notifications', 'action' => 'getNotifications')) . '"';?> >
		<input type="hidden" name="getNotificationsCount" value=<?= '"' . $this->HTML->url(array('controller' => 'notifications', 'action' => 'getNotificationsCount')) . '"';?> >
		<input type="hidden" name="getUsers" value=<?= '"' . $this->HTML->url(array('controller' => 'users', 'action' => 'getUsers')) . '"';?> >
		<input type="hidden" name="getGroups" value=<?= '"' . $this->HTML->url(array('controller' => 'groups', 'action' => 'getGroups')) . '"';?> >
		<input type="hidden" name="home" value=<?= '"' . Router::url('/', true) . '"';?> >
	</body>

</html>
