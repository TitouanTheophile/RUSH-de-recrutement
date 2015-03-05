<?php
class MessagesController extends AppController {

	public function index() {
		$messages = $this->Message->find('all', array(
			'contain' => array(
				'From',
				'To'
				),
			'conditions' => array(
				'OR' => array(
					'Message.target_id' => $this->Auth->user('id'),
					'Message.from_id' => $this->Auth->user('id')
					)
				),
			'fields' => array(
				'Message.created',
				'Message.content',
				'From.lastname',
				'From.firstname',
				'To.lastname',
				'To.firstname'
				),
			'order' => 'Message.created DESC'
			)
		);
		$this->set('messages', $messages);
	}

	public function send($id) { //Add a new message into database
		$this->loadModel('User');
		$from = $this->User->findById($id);

		if ($this->request->is('post') && !empty($this->request->data)) { //If the user send a message
			$this->Message->create(array( //Put the message into the database
				'from_id' => $this->Auth->user('id'),
				'target_id' => $id,
				'content' => $this->request->data['Message']['content']
				), true);
			$this->Message->save(null, true, array('from_id', 'target_id', 'content'));
			unset( $this->request->data['Message']['content']);

			$this->loadModel('Notification');
			$this->Notification->create(array( //Put the notification about the message into the database
				'from_id' => $this->Auth->user('id'),
				'target_id' => $id,
				'notificationType_id' => 1,
				'content_id' => $this->Message->getInsertID(),
				), true);
			$this->Notification->save(null, true, array('from_id', 'target_id', 'notificationType_id', 'content_id'));

			if (Configure::read('email')) { //Generation of the mail
				App::uses('CakeEmail', 'Network/Email');
				$email = new CakeEmail('default');
				$email->to($from['User']['email']);
				$email->subject($this->Auth->user('firstname') . ' ' . $this->Auth->user('lastname') . ' vous a envoyé un message sur socialkod');
				$email->emailFormat('html');
				$email->template('message');
				$email->viewVars(array('firstname' => $this->Auth->user('firstname'), 'lastname' => $this->Auth->user('lastname')));
				$email->send();
			}
		}
		$this->set('from', $from);
	}

	public function get_users_messages(){ //Get the Users for the view index
		$this->loadModel('User');
		$users = $this->User->find('all', array( //Get the list of Users that match with the search
			'conditions' => array(
				'firstname LIKE' => '%' . $this->params->query['q'] . '%'
				)
			));

		$this->set('users', $users);
		$this->layout = false;
		$this->render('/Elements/get_users_messages');
	}

	public function get_messages($id = null) { //Get the message for the view send
		$this->Message->updateAll( //To mark the messages as viewed
			array(
				'viewed' => 1
				),
			array(
				'from_id' => $id,
				'target_id' => $this->Auth->user('id')
				));

		$this->loadModel('Notification');
		$this->Notification->updateAll( //To update the notifications about the messages
			array(
				'viewed' => 1
				),
			array(
				'from_id' => $id,
				'target_id' => $this->Auth->user('id'),
				'notificationType_id' => 1
				));

		$messages = $this->Message->find('all', array( //Get all the messages of the conversation
			'conditions' => array(
				'OR' => array(
					array(
						'AND' => array(
							'Message.target_id' => $this->Auth->user('id'),
							'Message.from_id' => $id,
							)),
					array(
						'AND' => array(
							'Message.target_id' => $id,
							'Message.from_id' => $this->Auth->user('id'),
						)),
					)
				),
			'order' => 'Message.created ASC',
			));

		$this->set('messages', $messages);
		$this->layout = false;
		$this->render('/Elements/get_messages');
	}
}
?>