<?php
class Message extends AppModel {

	public $belongsTo = array( //Make the link beetween tables
		'From' => array(
			'className' => 'Users',
			'foreignKey' => 'from_id'
			),
		'To' => array(
			'className' => 'Users',
			'foreignKey' => 'target_id'
			)
		);

	public $validate = array( // Rule of validation to put the message inside the table
    	'content' => array(
        	'rule'    => array('minLength', 1),
        	'required'   => true,
        	'allowEmpty' => false,
        	'on'         => 'create',
        	'message'    => 'Veuillez remplir un message avant d\'envoyer'
    	));

    public function afterFind($results, $primary = false) { // To generate url for method view
		foreach ($results as $key => $result) {
			if (isset($result[$this->alias]['id'])) {
				$results[$key][$this->alias]['url'] = array(
					'controller' => 'messages',
					'action' => 'send',

					'id' => ($result['From']['id'] == CakeSession::read('User_id') ? $result['To']['id'] : $result['From']['id']),
					'name' => ($result['From']['id'] == CakeSession::read('User_id') ? $result['To']['firstname'] . '.' . $result['To']['lastname'] : $result['From']['firstname'] . '.' . $result['From']['lastname'])
					);
			}
		}
		return ($results);
	}
}
?>