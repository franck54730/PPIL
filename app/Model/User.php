<?php
class User extends AppModel {

	var $name = 'User';
	var $useTable = 'users';


	public $validate = array(
			'login' => array(
					'rule' => array('notEmpty'),
					'message'=>'Ce champ ne doit pas etre vide!'
			),
			'password' => array(
					'confirm' => array(
							'rule' => array('password', 'password_r', 'confirm'),
							'message' => 'Les mots se doivent d\'être identiques.',
							'last' => true
					),
					'length' => array(
							'rule' => array('password', 'password_r', 'length'),
							'message' => '6 caracteres minimum.'
					),
					'rule'=>'notEmpty',
					'allowEmpty' => false,
					'message'=>'Mot de passe obligatoire'
			),

			'password_r' => array(
					'notempty' => array(
							'rule' => array('notEmpty'),
							'allowEmpty' => false,
							'message' => 'Confirmer votre mot de passe.'
					)
			),

			'nom'=> array(
			array(
				'rule'=> 'alphanumeric',
				'required'=> true,
				'allowEmpty' => false

			)
		),

		'prenom'=> array(
			array(
				'rule'=> 'alphanumeric',
				'required'=> true,
				'allowEmpty' => false
				
			)
		),

		'mail'=> array(
			array(
				'rule'=> 'email',
				'required'=> true,
				'allowEmpty' => false,
				'message'=>'Email non valide'
			),
			array(
				'rule'=>'isUnique',
				'message'=>'Email déjà existante'
			)
		),

	);
}
