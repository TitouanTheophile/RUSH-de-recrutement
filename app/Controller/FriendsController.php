<?php

class FriendsController extends AppController {
	var $uses = array('Friend', 'User');

	public function index() {
        $this->set('friends', $this->Friend->find('all'));
    }

    public function getFriendInfo($from_id) {
    	return $this->Friend->find('all');
    }
}
?>