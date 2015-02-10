<?php

class ProfilesController extends AppController {
	function Login () {

		if ($this->request->is('post'))
		 {
		 	$this->set(array('error' => 'false'));
			$this->Session->write('id', 0);
			$userInfo = $this->request->data['Login'];
			if(($answer = $this->Profile->find('first', array(
					'fields' => array('id', 'password'),
					'conditions' => array('email' => $userInfo['email'])
					))) == false)
			{
				$this->set(array('error' => 'true'));
				$this->set(array('errInfo' => 'email'));
				$this->render('Login');
			}
			else
			{
				if ($answer != NULL && 
					$answer['Profile']['password'] == $userInfo['password'])
				{
					$this->Session->write('id',$answer['Profile']['id']);	
					$this->set(compact($answer));
					//return $this->redirect(array('controller' => 'Notifications', 'action' => 'hello'));
				}
				else
				{
					$this->set(array('error' => 'true'));
					$this->set(array('errInfo' => 'password'));
					$this->render('Login');
				}
			}
		}
	}

	function register () {
		echo "je suis la";
	}

	function logOut () {

	}
}
?>