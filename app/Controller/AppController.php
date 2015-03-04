<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
		'DebugKit.Toolbar',
		'Session',
		'Auth' => array(
	        'authenticate' => array(
	            'Form' => array(
	                'fields' => array('username' => 'email')
	            )
	        )
	    )
    );

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('display');
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
	    $this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'home');
        $this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'home');
	}

	public function try_arg($assert, $message, $url) {
		if ($assert) {
			$this->Session->setFlash(__($message));
			$this->redirect($url);
		}
		else
			return true;
	}

	public function allowFriend($id, $message) {
		$friends_verification = $this->requestAction('friends/isFriend',
													 array('pass' => array($this->Session->read('Auth.User.id'), $id)));
		$this->try_arg(($friends_verification != 1 && $id != $this->Session->read('Auth.User.id')), $message,
					   array('controller' => 'users', 'action' => 'view', $this->Session->read('Auth.User.id')));
		return true;
	}
}
