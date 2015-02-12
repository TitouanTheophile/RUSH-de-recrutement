<div id="user_header">
	<?php 
		echo $this->element('user_photo');
	?>
</div>

<div id="wall_infos">
	<div class="container_padding">
		<table>
			<td><h4>Infos publiques</h4></td>
			<td><?php echo $this->Html->link(
                'Éditer',
                array('action' => 'editInfo', $user['User']['id'])
            ); ?></td>
        </table>
		<hr />
		<div class="container_padding">
			<?php if ( !empty($user['User']['study_place']) ) {
				echo "<p>Étudie à <strong>" . $user['User']['study_place'] . "</strong></p>";
			} ?>
			<?php if ( !empty($user['User']['work_place']) ) {
				echo "<p>Travaille à <strong>" . $user['User']['work_place'] . "</strong></p>";
			} ?>
			<?php if ( !empty($user['User']['user_place']) ) {
				echo "<p>Habite à <strong>" . $user['User']['user_place'] . "</strong></p>";
			} ?>
			<?php if ( !empty($user['User']['birthday']) ) {
				echo "<p>Date d'anniversaire : <strong>" . $user['User']['birthday'] . "</strong></p>";
			} ?>
			<?php if ( !empty($user['User']['created']) ) {
				echo "<p>Present sur SocialKOD depuis le <strong>" . $user['User']['created'] . "</strong></p>";
			} ?>
		</div>

		<table>
			<td><h4>Cordonnées</h4></td>
			<td><?php echo $this->Html->link(
                'Éditer',
                array ('action' => 'editData', $user['User']['id'])
            ); ?></td>
        </table>
		<hr />
		<div class="container_padding">
			<p>Mon email : <strong><?php echo $user['User']['email']; ?></strong> </p>
		</div>

	</div>
</div><!--

--><div id="user_wall">
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