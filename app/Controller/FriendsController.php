<?php

class FriendsController extends AppController {
	var $uses = array('Friend', 'User', 'Notification');

	public function index() {
        $this->set('friends', $this->Friend->find('all'));
    }

    public function getFriendInfo($from_id) {
    	return $this->Friend->find('all');
    }

	function isFriend($user_id, $other_id)
	{
		$small_id = 0;
		$big_id = 0;
		if ($user_id < $other_id) {
			$small_id = $user_id;
			$big_id = $other_id;
		}
		else if ($user_id > $other_id) {
			$small_id = $other_id;
			$big_id = $user_id;
		}
		if (($answer = $this->Friend->find('first',
			array( 'fields'  =>	array('pending'),
					'conditions' =>	array('user1_id' => $small_id, 'user2_id' => $big_id)))) != false) {
			if ($answer['Friend']['pending'] == NULL)
				return 1;
			else {
				return 0;
			}
		}
		else {
			return -1;
		}
	}

	function addFriend($id) {
		App::uses('CakeEmail', 'Network/Email');
		$little = 0;
		$big = 0;
		if ($this->Auth->user('id') < $id) {
			$little = $this->Auth->user('id');
			$big = $id;
		}
		else if ($this->Auth->user('id') > $id) {
			$little = $id;
			$big = $this->Auth->user('id');
		}
		$this->Friend->create();
		$d = array(
			'Friend' => array(
				'user1_id' => $little,
				'user2_id' => $big,
				'pending' => $id
			)
		);
		$this->Friend->save($d);
		$from = $this->User->findById($id);
		$this->Notification->create(array(
				'from_id' => $this->Auth->user('id'),
				'target_id' => $id,
				'notificationType_id' => 2,
				'content_id' => $this->Friend->getInsertID(),
				), true);
		$this->Notification->save(null, true, array('from_id', 'target_id', 'notificationType_id', 'content_id'));
		if (Configure::read('email')) {
				$email = new CakeEmail('default');
				$email->to($from['User']['email']);
				$email->subject($this->Auth->user('firstname') . ' ' . $this->Auth->user('lastname') . ' vous a demandé en ami sur socialkod');
				$email->emailFormat('html');
				$email->template('add_friend');
				$email->viewVars(array('firstname' => $this->Auth->user('firstname'), 'lastname' => $this->Auth->user('lastname')));
				$email->send();
			}
		$this->Session->setFlash(__("Votre demande d'ami a ete envoye"));
		return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
	}

	function acceptFriend($id) {
		App::uses('CakeEmail', 'Network/Email');
		$this->Friend->id = $id;
		$this->Friend->saveField('pending', NULL);
		$this->Session->setFlash(__("Vous avez bien valide la demande d'amitie"));

		$friend = $this->Friend->findById($id);
		$from = $this->User->findById(($friend['Friend']['pending'] == $friend['Friend']['user1_id'] ? $friend['Friend']['user1_id'] : $friend['Friend']['user2_id']));

		$this->Notification->create(array(
				'from_id' => $this->Auth->user('id'),
				'target_id' => $from['User']['id'],
				'notificationType_id' => 3,
				'content_id' => $id,
				), true);
		$this->Notification->save(null, true, array('from_id', 'target_id', 'notificationType_id', 'content_id'));
		if (Configure::read('email')) {
				$email = new CakeEmail('default');
				$email->to($from['User']['email']);
				$email->subject($this->Auth->user('firstname') . ' ' . $this->Auth->user('lastname') . ' a accepté votre demande d\'ami sur socialkod');
				$email->emailFormat('html');
				$email->template('accept_friend');
				$email->viewVars(array('firstname' => $this->Auth->user('firstname'), 'lastname' => $this->Auth->user('lastname')));
				$email->send();
			}
			return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
	}

	function deleteFriend($id) {
		if ($this->Auth->user('id') <= $id) {
			$deleteTarget = $this->Friend->find('first', array(
				'fields' => 'id',
				'conditions' =>	array('user1_id' => $this->Auth->user('id'), 'user2_id' => $id))
			);
		}
		else if ($this->Auth->user('id') > $id) {
			$deleteTarget = $this->Friend->find('first', array(
				'fields' => 'id',
				'conditions' =>	array('user1_id' => $id, 'user2_id' => $this->Auth->user('id')))
			);
		}
		if ($this->Friend->delete($deleteTarget['Friend']['id'], true)) {
			$this->Session->setFlash(__("Votre ami n'en est plus un desormais :("));
		}
		return $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
	}
}
?>