<?php

class User extends AppModel {
    var $hasMany = array(
         'Content' => array(
            'foreignKey' => 'from_id',
            'dependent'=> true
        )
    );

	public $validate = array(
        'firstname' => array(
            'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => 'Chiffres et lettres uniquement !'
            ),
            'between' => array(
                'rule'    => array('lengthBetween', 4, 60),
                'message' => 'Votre prénom doit comprendre entre 4 et 60 caractères'
            )
        ),
        'lastname' => array(
            'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => 'Chiffres et lettres uniquement !'
            ),
            'between' => array(
                'rule'    => array('lengthBetween', 4, 60),
                'message' => 'Votre nom doit comprendre entre 4 et 60 caractères'
            )
        ),
        'password' => array(
            'rule'    => array('minLength', '8'),
            'message' => '8 caractères minimum'
        ),
        'password_confirmation' => array(
            'rule'    => 'notEmpty',
            'message' => 'Veuillez vérifier le mot de passe'
        ),
        'email' => array(
        	'email' => array(
                'rule'    => 'email',
                'message' => 'Veuillez rentrer une adresse email valide'
            ),
            'isUnique' => array(
                'rule'    => 'isUnique',
                'message' => 'Cet email est deja pris, veuillez en utiliser un autre'
            )
        )
    );

    /*public function matchPasswords($data) {
        if ( $data['password'] == $this->data['User']['password_confirmation'] ) {
            return true;
        }
        $this->invalidate('password_confirmation', 'Vos mots de passe ne correspondent pas');
        return false;
    }*/

    public function beforeSave($options = array()) {
        
        /* password hashing */    
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

}