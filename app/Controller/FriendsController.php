<?php

class FriendsController extends AppController {

	function is_friend($user_id, $other_id)
	{
		$this->set(array('is_friend' => -2));
		if ($user_id > $other_id)
			{
				$big_id = $user_id;
				$small_id = $other_id;
			}
		else if ($user_id < $other_id)
			{
				$small_id = $user_id;
				$big_id = $other_id;
			}
			if (($answer = $this->Friend->find('first',
			 array(	'fields' 	 =>	array('pending'),
					'conditions' =>	array('profile1_id' => $small_id, 'profile2_id' => $big_id)))) != false)
		$this->set(array('is_friend' => $answer['Friend']['pending']));	
	}	

}
?>