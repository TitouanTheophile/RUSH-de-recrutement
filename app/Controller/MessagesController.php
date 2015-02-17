<?php
class MessagesController extends AppController {

	public function index() { // Get latest messages for the index view
		$messages = $this->Message->find('all', array( //Display the latest message
			'conditions' => array(
				'OR' => array(
					'Message.target_id' => $this->Auth->user('id'),
					'Message.from_id' => $this->Auth->user('id')
					)
				),
			'order' => 'Message.created DESC'
			));
		$this->set('messages', $messages);
	}

	public function send($id = null) { // Add a new message into database
		if ($this->request->is('post') && !empty($this->request->data)) { // If the user send a message
			$this->Message->create(array( // Put the message into the database
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
		}
		$this->loadModel('User');
		$from = $this->User->findById($id);
		$this->set('from', $from);
	}

	public function get_users(){ // Get the Users for the view index
		$this->loadModel('User');
		$users = $this->User->find('all', array( //Get the list of Users that match with the search

			'conditions' => array(
				'firstname LIKE' => '%' . $this->params->query['q'] . '%'
				)
			));


		$this->set('users', $users);
		$this->layout = false;
		$this->render('/Elements/get_users');
	}

	public function get_messages($id = null) { // Get the message for the view send
		$this->Message->updateAll( // To mark the message as viewed
			array(
				'viewed' => 1
				),
			array(
				'from_id' => $id,

				'target_id' => $this->Auth->user('id')
				));

		$this->loadModel('Notification');
		$this->Notification->updateAll( // To update the notifications about the messages
			array(
				'viewed' => 1
				),
			array(
				'from_id' => $id,
				'target_id' => $this->Auth->user('id'),
				'notificationType_id' => 1
				));

		$messages = $this->Message->find('all', array( // Get all the messages of the conversation
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