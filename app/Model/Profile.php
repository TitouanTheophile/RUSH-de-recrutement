<?php

class Profile extends AppModel {
	function beforeFind($query)
	{
		if (preg_match("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,}$/i",$query['conditions']['email']) == false)
			return false;
		return $query;
	}
	
	function afterFind($answer, $bool = false)
	{
		if (!empty($answer))
		return $answer;
		else
		return NULL;
	}
}
?>