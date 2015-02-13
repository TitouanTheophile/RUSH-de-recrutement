<?php
class MessagesController extends AppController {
	public $scaffold;
	public function index() { // Get latest messages for the index view
		$messages = $this->Message->find('all', array( //Display the latest message
			'conditions' => array(
				'OR' => array(
					'Message.target_id' => $this->Session->read('User_id'),
					'Message.from_id' => $this->Session->read('User_id')
					)
				),
			'order' => 'Message.created DESC',
			));
		$this->set('messages', $messages);
	}

	public function view() { // Add a new message into database
		if ($this->request->is('post') && !empty($this->request->data)) { // If the user send a message
			$this->Message->create(array( // Put the message into the database
				'from_id' => $this->Session->read('User_id'),
				'target_id' => $this->params['named']['id'],
				'content' => $this->request->data['Message']['content']
				), true);
			$this->Message->save(null, true, array('from_id', 'target_id', 'content'));
			unset( $this->request->data['Message']['content']);

			$this->loadModel('Notification');
			$this->Notification->create(array( //Put the notification about the message into the database
				'from_id' => $this->Session->read('User_id'),
				'target_id' => $this->params['named']['id'],
				'notificationType_id' => 1,
				'content_id' => $this->Message->getInsertID(),
				), true);
			$this->Notification->save(null, true, array('from_id', 'target_id', 'notificationType_id', 'content_id'));
		}
	}

	public function get_users(){ // Get the users for the index view
		$this->autoRender = false; // Avoid to create a view

		$this->loadModel('User');
		$users = $this->User->find('all', array( //Get the list of users that match with the search
			'conditions' => array(
				'firstname LIKE' => '%' . $this->params->query['q'] . '%'
				)
			));

		$users = array_filter($users);
		if (empty($users))
			echo "<h3>Pas de résultat :(</h3>";
		foreach ($users as $user) {
			echo ('<a href="' . '/messages/view/id:' . $user['User']['id'] . '/name:' . $user['User']['firstname'] . '.' . $user['User']['lastname'] . '">' . 
			$user['User']['firstname'] . ' ' . $user['User']['lastname'] . '</a><br>' );
		}
	}

	public function get_messages() { // Get the message for the view view
		App::uses('CakeTime', 'Utility'); // To use helper Time inside the controller
		$this->autoRender = false; // Avoid to create a view
		
		$this->Message->updateAll( // To mark the message as viewed
			array(
				'view' => 1
				),
			array(
				'from_id' => $this->params->named['id'],
				'target_id' => $this->Session->read('User_id')
				));

		$this->loadModel('Notification');
		$this->Notification->updateAll( // To update the notifications about the messages
			array(
				'view' => 1
				),
			array(
				'from_id' => $this->params->named['id'],
				'target_id' => $this->Session->read('User_id'),
				'notificationType_id' => 1
				));

		$messages = $this->Message->find('all', array( // Get all the messages of the conversation
			'conditions' => array(
				'OR' => array(
					array(
						'AND' => array(
							'Message.target_id' => $this->Session->read('User_id'),
							'Message.from_id' => $this->params->named['id'],
							)),
					array(
						'AND' => array(
							'Message.target_id' => $this->params->named['id'],
							'Message.from_id' => $this->Session->read('User_id'),
						)),
					)
				),
			'order' => 'Message.created ASC',
			));
		
		foreach ($messages as $message) {
			echo ('<a href="google.fr">' . $message['From']['firstname'] . ' ' . $message['From']['lastname'] . '</a> ' . CakeTime::format($message['Message']['created'], '%e/%m/%G %H:%M') . '<br>');
			echo ($message['Message']['content'] . '<br><br>');
		}
	}
}
?>