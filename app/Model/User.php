<?php
class User extends AppModel {

	var $name = 'User';
	var $useTable = 'users';
<<<<<<< HEAD
	public $actsAs = array(
						'Upload.Upload' => array(
						'fields' => array(
						'photo' => 'img/avatars/%id1000/%id'))
					);
=======

>>>>>>> 3e9bfef52c1b409f37811418de88aafac8478a3c

	public $validate = array(
			'login' => array(
					'rule' => array('notEmpty'),
					'message'=>'Ce champ ne doit pas etre vide!'
			),
<<<<<<< HEAD
			'mot_de_passe' => array(
					'confirm' => array(
							'rule' => array('mot_de_passe', 'mot_de_passe_r', 'confirm'),
=======
			'password' => array(
					'confirm' => array(
							'rule' => array('password', 'password_r', 'confirm'),
>>>>>>> 3e9bfef52c1b409f37811418de88aafac8478a3c
							'message' => 'Les mots se doivent d\'être identiques.',
							'last' => true
					),
					'length' => array(
<<<<<<< HEAD
							'rule' => array('mot_de_passe', 'mot_de_passe_r', 'length'),
							'message' => '6 caracteres minimum.'
					),
					'rule'=>'notEmpty',
					'allowEmpty' => false,
					'message'=>'Mot de passe obligatoire'
			),

			'mot_de_passe_r' => array(
=======
							'rule' => array('password', 'password_r', 'length'),
							'message' => '6 caracteres minimum.'
					)
			),
			'password_r' => array(
>>>>>>> 3e9bfef52c1b409f37811418de88aafac8478a3c
					'notempty' => array(
							'rule' => array('notEmpty'),
							'allowEmpty' => false,
							'message' => 'Confirmer votre mot de passe.'
					)
<<<<<<< HEAD
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

			'sexe'=> array(
				array(
					'rule'=> 'alphanumeric',
					'required'=> true,
					'allowEmpty' => false

				)
			),

			'photo_file'=> array(
			array(
				'required'=> false,
				'allowEmpty' => true,
				'rule'=> array('fileExtension',array('jpg','jpeg','png')),
				'message'=> 'Vous ne pouvez envoyer que des jpg, jpeg, png'
				

			)
		),
			
	);

	
}
?>
=======
			)
	);
}
>>>>>>> 3e9bfef52c1b409f37811418de88aafac8478a3c
