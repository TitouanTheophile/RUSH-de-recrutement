<?php 

class ContentP extends AppModel {
	public $useTable = 'contents_profiles';
	public $belongsTo = array(
		'Contents' => array(
			'foreignKey' => 'content_id'),
		'Profiles' => array(
			'foreignKey' => 'profile_id'));
}

?>