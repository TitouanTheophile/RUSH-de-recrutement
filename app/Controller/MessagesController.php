<?php
class MessagesController extends AppController {

	public function index()
	{
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
				'To.firstname',
				),
			'group' => array('Message.target_id'),
			'order' => 'Message.created DESC',
			)
		);
		$this->set('messages', $messages);
	}

	public function send($id)
	{
		$this->loadModel('Notification');
		
		if ($this->request->is('post'))
			{
				$this->Message->create(array(
					'from_id' => $this->Auth->user('id'),
					'target_id' => $id,
					'content' => $this->request->data['Message']['content']
					)
				);
				$this->Message->save(null, true, array('from_id', 'target_id', 'content'));
				unset($this->request->data['Message']['content']);

				$this->Notification->create(array(
					'from_id' => $this->Auth->user('id'),
					'target_id' => $id,
					'notificationType_id' => 1,
					'content_id' => $this->Message->getInsertID()
					)
				);
				$this->Notification->save(null, true, array('from_id', 'target_id', 'notificationType_id', 'content_id'));

				if (Configure::read('email'))
				{
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

		$to = $this->Message->To->find('first', array(
			'conditions' => array(
				'To.id' => $id	
			),
			'fields' => array(
				'To.lastname',
				'To.firstname',
				'To.id'
			)
		));
		$this->set($to);
	}

	public function searchUsersMessages()
	{
		$this->loadModel('User');
		$this->layout = 'ajax';
		$this->render('/Elements/searchUsersMessages');

		$users = $this->User->find('all', array(
			'conditions' => array(
				'OR' => array(
					'User.lastname LIKE' => '%' . $this->params->query['q'] . '%',
					'User.firstname LIKE' => '%' . $this->params->query['q'] . '%'
					)
				),
			'fields' => array(
				'User.id',
				'User.lastname',
				'User.firstname'
				)
			)
		);
		$this->set('users', $users);
	}

	public function getMessages($id)
	{
		$this->loadModel('Notification');
		$this->layout = 'ajax';
		$this->render('/Elements/getMessages');

		$this->Notification->updateAll(
			array('viewed' => 1),
			array('from_id' => $id, 'target_id' => $this->Auth->user('id'), 'notificationType_id' => 1)
		);

		$messages = $this->Message->find('all', array(
			'contain' => array(
				'From'
				),
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
			'fields' => array(
				'Message.created',
				'Message.content',
				'From.lastname',
				'From.firstname'
				),
			'order' => 'Message.created ASC',
			));
		$this->set('messages', $messages);
	}
}
?>