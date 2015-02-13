<?php

class Comment extends AppModel
{
	public $validate = array (
		'content' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false
			));
}
?>