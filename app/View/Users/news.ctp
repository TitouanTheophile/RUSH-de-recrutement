<?= $this->Html->css('users', array('inline' => false)); ?>
<div id="news_profil">
	<?= $this->element('user_photo', array('user' => $user['User'])); ?>
	<div id="wall_infos">
		<div class="container_padding20">
			Hey Hey Hey !! Sauce moi ca !
		</div>
	</div>
</div>
<div id="news_wall">
	<div class="container_padding">
		<h4>Fil d'actualite</h4>
		<hr />
		<div class="container_padding">

			<?php
				echo $this->Html->link('Publier un post',
                array ('action' => 'sendPost', $user['User']['id']));
			?>

	    	<?php
	    		$index = count($contents);
	    		while($index) {
	    			$content = $contents[--$index];
		    		if ( $content['Content']['from_id'] == $user['User']['id'] 
		    			|| $content['Content']['target_id'] == $user['User']['id'] ) {
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
		    	unset($content);
	    	?>

		</div>
	</div>
</div>