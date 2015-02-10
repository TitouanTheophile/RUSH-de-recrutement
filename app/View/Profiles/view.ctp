<div id="profile_header">
	<?php 
		echo $this->element('profile_photo');
	?>
</div>

<div id="wall_infos">
	<div class="container_padding">
		<table>
			<td><h4>Infos publiques</h4></td>
			<td><?php echo $this->Html->link(
                'Éditer',
                array('action' => 'editInfo', $profile['Profile']['id'])
            ); ?></td>
        </table>
		<hr />
		<div class="container_padding">
			<?php if ( !empty($profile['Profile']['study_place']) ) {
				echo "<p>Étudie à <strong>" . $profile['Profile']['study_place'] . "</strong></p>";
			} ?>
			<?php if ( !empty($profile['Profile']['work_place']) ) {
				echo "<p>Travaille à <strong>" . $profile['Profile']['work_place'] . "</strong></p>";
			} ?>
			<?php if ( !empty($profile['Profile']['user_place']) ) {
				echo "<p>Habite à <strong>" . $profile['Profile']['user_place'] . "</strong></p>";
			} ?>
			<?php if ( !empty($profile['Profile']['birthday']) ) {
				echo "<p>Date d'anniversaire : <strong>" . $profile['Profile']['birthday'] . "</strong></p>";
			} ?>
			<?php if ( !empty($profile['Profile']['created']) ) {
				echo "<p>Present sur SocialKOD depuis le <strong>" . $profile['Profile']['created'] . "</strong></p>";
			} ?>
		</div>

		<table>
			<td><h4>Cordonnées</h4></td>
			<td><?php echo $this->Html->link(
                'Éditer',
                array ('action' => 'editData', $profile['Profile']['id'])
            ); ?></td>
        </table>
		<hr />
		<div class="container_padding">
			<p>Mon email : <strong><?php echo $profile['Profile']['email']; ?></strong> </p>
		</div>

	</div>
</div><!--

--><div id="profile_wall">
	<div class="container_padding">
		<h4>Mon actualité</h4>
		<hr />
		<div class="container_padding">

	    	<?php
	    		foreach ($contents as $content) {
		    		if ( $content['Content']['from_id'] == $profile['Profile']['id'] 
		    			|| $content['Content']['target_id'] == $profile['Profile']['id'] ) {
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