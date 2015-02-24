<?= $this->Html->css('users', array('inline' => false)); ?>
<?= $this->Html->css('content', array('inline' => false)); ?>
<div id="news_profil">
	<div id="user_header">
	<?php
		header('Refresh: 60; URL=');
	 	echo $this->element('user_photo', array('user' => $user['User'])); 
	 ?>
	 </div>
	<div id="wall_infos">
		<div class="container_padding20">
			<h1>Mes groupes</h1>
			<?= $this->Html->link($this->Html->image('plus.png'),
				array('controller' => 'groups', 'action' => 'create_group'),
				array('escape' => false)); ?>
			<?php
				if (empty($user['Group']))
					echo "Vous n'avez pas de groupe";
				else {
					foreach ($user['Group'] as $group) {
						echo '<div>' . $this->Html->link($group['name'],
		           						   	array('controller' => 'groups', 'action' => 'view', $group['id'])) . '</div>';
					}
				}
			?>
		</div>
	</div>
</div>
<div id="news_wall">
	<div class="container_padding">
		<h4>Fil d'actualite</h4>
		<hr />
		<div class="container_padding">

			<?php
	    		if ( $user['User']['id'] == $this->Session->read('Auth.User.id') ) {
					echo $this->Html->link('Publier un post',
                		array ('action' => 'sendPost', $user['User']['id']));
		    		$index = count($contents);
		    		while($index) {
		    			$content = $contents[--$index];

			    			foreach ($posts as $post) {
			    				if ( $post['Post']['id'] == $content['Content']['content_id'] ) {
									echo $this->element(
										'post',
										array (
											'post_content' => $post['Post']['content'],
											'content' => $content
										)
									);
								}
			    			}
			    			unset($post);
			    	}
			    }
			    else {
			    	echo "Vous devez etre ami avec <strong>" . $user['User']['firstname'] . " " . $user['User']['lastname'] . "</strong> pour suivre son activite ou publier sur son mur.";
			    }
	    	?>

		</div>
	</div>
</div>