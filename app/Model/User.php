<?php

class User extends AppModel {

    public $hasMany = array(
        'Content_from' => array(
            'className' => 'Content',
            'foreignKey' => 'from_id',
            'dependent'=> true
        ),
        'Content_target' => array(
            'className' => 'Content',
            'foreignKey' => 'target_id',
            'dependent'=> true
        ),
        'Content_target' => array(
            'className' => 'Content',
            'foreignKey' => 'target_id',
            'dependent'=> true
        ),
        'ContentP' => array(
            'foreignKey' => 'user_id',
            'dependent' => true)
    );
    
    public $hasAndBelongsToMany = array(
        'Group' =>
            array(
                'className' => 'Group',
                'joinTable' => 'groups_users',
                'foreignKey' => 'user_id',
                'associationForeignKey' => 'group_id',
            )        
    );

	public $validate = array(
        'firstname' => array(
            'alpha' => array(
                'rule'     => '/^[a-z\-A-Z]+$/i',
                'required' => true,
                'message'  => 'Lettres uniquement !'
            ),
            'between' => array(
                'rule'    => array('lengthBetween', 2, 50),
                'message' => 'Votre prénom doit comprendre entre 2 et 50 caractères'
            )
        ),
        'lastname' => array(
            'alpha' => array(
                'rule'     => '/^[a-z \-A-Z]+$/i',
                'required' => true,
                'message'  => 'Lettres uniquement !'
            ),
            'between' => array(
                'rule'    => array('lengthBetween', 2, 50),
                'message' => 'Votre nom doit comprendre entre 2 et 50 caractères'
            )
        ),
        'password' => array(
            'rule'    => array('minLength', '8'),
            'message' => '6 caractères minimum'
        ),
        'password_confirmation' => array(
            'rule' => array('equalToField', 'password'),
            'message' => 'Veuillez vérifier le mot de passe'
        ),
        'email' => array(
        	'email' => array(
                'rule'    => 'email',
                'message' => 'Veuillez entrer une adresse email valide'
            ),
            'isUnique' => array(
                'rule'    => 'isUnique',
                'message' => 'Cet email est deja pris, veuillez en utiliser un autre'
            )
        ),
        'birthday' => array(
            'rule' => 'datetime',
            'message' => 'Veuillez entrer une date valide',
            'allowEmpty' => true
        )
    );

    public function equalToField($array, $field) {
        return strcmp($this->data[$this->alias][key($array)], $this->data[$this->alias][$field]) == 0;
    }

    public function beforeSave($options = array()) {
        
        /* password hashing */    
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

}