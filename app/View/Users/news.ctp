<div id="news_profil">
	<?php 
		echo $this->element('user_photo');
	?>
</div><!--

--><div id="news_contents">
	<div class="container_padding">
		<h4>Mon actualité</h4>
		<hr />
		<div class="container_padding">

	    	<?php
	    		foreach ($contents as $content) {
		    		if ( $content['Content']['from_id'] == $user['User']['id'] 
		    			|| $content['Content']['target_id'] == $user['User']['id'] ) {
		    			foreach ($posts as $post) {
		    				if ( $post['Post']['id'] == $content['Content']['content_id'] ) {
								echo $this->element(
									'post',
									array (
										'post_content' => $post['Post']['content'],
										'from_id' => $content['Content']['from_id']
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