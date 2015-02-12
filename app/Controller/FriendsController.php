<?php

class FriendsController extends AppController {

	function is_friend($user_id, $other_id)
	{
		$this->layout = false;
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
					'conditions' =>	array('user1_id' => $small_id, 'user2_id' => $big_id)))) != false)
			{
				if ($answer['Friend']['pending'] == NULL)
					$this->render('is_friend');
				else
					$this->render('pending');
			}
			else
				$this->render('is_not_friend');
	}	

}
?>