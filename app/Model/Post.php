<?php

class Post extends AppModel {
	public $hasOne = array(
		'Content' => array(
			'foreignKey' => 'id'
			)
		);
}
?>