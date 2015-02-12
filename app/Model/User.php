<?php

class User extends AppModel {

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
}