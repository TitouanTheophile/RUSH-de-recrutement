<?php
class CsvShell extends AppShell {
	public $uses = array('User');

    public function main() {
    	App::import('Component','Auth');
    	if (!isset($this->args[0]) || !file($this->args[0])) {
    		$this->err(__('Please provide a valid file', true));
    		$this->_stop();
      	}
		$csv = array_map('str_getcsv', file($this->args[0]));
		print_r($csv);
		for ($i=0; $i < count($csv); $i++) { 

			$firstname = $this->get_firstname($csv[$i][0], $i);
			$lastname = $this->get_lastname($csv[$i][1], $i);
			$email = $this->get_email($csv[$i][2], $i);
			$gender = $this->get_gender($csv[$i][4], $i);
			$password = $this->get_password($csv[$i][3], $i);
			$study_place = $this->get_study_place($csv[$i][5], $i);
			$work_place = $this->get_work_place($csv[$i][6], $i);
			$user_place = $this->get_user_place($csv[$i][7], $i);
			$birthday = $this->get_birthday($csv[$i][8], $i);

			$this->User->create(array(
				'firstname' => $firstname,
				'lastname' => $lastname,
				'email' => $email,
				'password' => $password,
				'gender' => 0,
				'study_place' => $study_place,
				'work_place' => $work_place,
				'user_place' => $user_place,
				'birthday' => $birthday,
			), true);
			$this->User->save(null, true, array('firstname', 'lastname', 'email', 'password', 'gender', 'study_place', 'work_place', 'user_place', 'birthday'));
		}
    }

    private function get_firstname($str, $i) {
    	if (!isset($str))
    		$this->err(__("Please enter a firstname on line $i", true));
    	else if (!ctype_alpha($str))
			$this->err(__("Please enter a firstname with only character on line $i", true));
		else if (!(4 <= strlen($str) && strlen($str) <= 60))
			$this->err(__("Please enter a firstname with a length between 4 and 60 characters on line $i", true));
		else
			return $str;
		return false;
    }

    private function get_lastname($str, $i) {
    	if (!isset($str))
    		$this->err(__("Please enter a lastname on line $i", true));
    	else if (!ctype_alpha($str))
			$this->err(__("Please enter a lastname with only character on line $i", true));
		else if (!(4 <= strlen($str) && strlen($str) <= 60))
			$this->err(__("Please enter a lastname with a length between 4 and 60 characters on line $i", true));
		else
			return $str;
		return false;
    }

    private function get_email($str, $i) {
    	if (!isset($str))
    		$this->err(__("Please enter an email on line $i", true));
    	else if (!preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{1,}\.[a-zA-Z]{2,4}$/', $str))
    		$this->err(__("Please enter a valid email on line $i", true));
    	else if (count($this->User->findByEmail($str)) == 2)
    		$this->err(__("The email on line $i is already taken", true));
    	else
			return $str;
		return false;
    }

    private function get_password($str, $i) {
    	if (!isset($str))
    		$this->err(__("Please enter a password on line $i", true));
    	else if (strlen($str) < 8)
    		$this->err(__("Please enter a password with at least 8 characters on line $i", true));
    	else
			return $str;
		return false;
    }

    private function get_gender($str, $i) {
    	if (isset($str)) {
    		if($str != 'M' && $str != 'F')
    			$this->err(__("Please enter a correct gender on line $i", true));
    		else
    			return 0;
    		return false;
    	}
    	return NULL;
    }

    private function get_study_place($str, $i) {
    	if (isset($str)) {
    		if(strlen($str) > 255)
    			$this->err(__("Please enter a study place with less than 256 characters on line $i", true));
    		else
    			return $str;
    		return false;
    	}
    	return NULL;
    }

    private function get_work_place($str, $i) {
    	if (isset($str)) {
    		if(strlen($str) > 255)
    			$this->err(__("Please enter a work place with less than 256 characters on line $i", true));
    		else
    			return $str;
    		return false;
    	}
    	return NULL;
    }

    private function get_user_place($str, $i) {
    	if (isset($str)) {
    		if(strlen($str) > 255)
    			$this->err(__("Please enter a user place with less than 256 characters on line $i", true));
    		else
    			return $str;
    		return false;
    	}
    	return NULL;
    }

    private function get_birthday($str, $i) {
    	if (isset($str) && strlen($str) > 1) {
    		$birthday = date_create($str);
    		if(!$birthday)
    			$this->err(__("Please enter a valid birthday on line $i", true));
    		else
    			return date_format($birthday, 'Y-m-d %H:%i:%s');
    		return false;
    	}
    	return date_create(time());
    }
}
?>