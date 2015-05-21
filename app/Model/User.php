<?php
class User extends AppModel {

	var $name = 'User';
	var $useTable = 'users';
	public $actsAs = array(
						'Upload.Upload' => array(
						'fields' => array(
						'photo' => 'img/avatars/%id1000/%id'))
					);

	public $validate = array(
			'login' => array(
					'rule' => array('notEmpty'),
					'message'=>'Ce champ ne doit pas etre vide!'
			),
			'mot_de_passe' => array(
					'confirm' => array(
							'rule' => array('mot_de_passe', 'mot_de_passe_r', 'confirm'),
							'message' => 'Les mots se doivent d\'être identiques.',
							'last' => true
					),
					'length' => array(
							'rule' => array('mot_de_passe', 'mot_de_passe_r', 'length'),
							'message' => '6 caracteres minimum.'
					),
					'rule'=>'notEmpty',
					'allowEmpty' => false,
					'message'=>'Mot de passe obligatoire'
			),

			'mot_de_passe_r' => array(
					'notempty' => array(
							'rule' => array('notEmpty'),
							'allowEmpty' => false,
							'message' => 'Confirmer votre mot de passe.'
					)
			),

			'nom'=> array(
				array(
					'rule'=> array('custom', '/^[a-zA-Z]{1,}[a-zA-Z -]{1,}$/'),
					'required'=> true,
					'allowEmpty' => false,
					'message' => 'Champ incorrect'

				)
			),

			'prenom'=> array(
				array(
					'rule'=> array('custom', '/^[a-zA-Z]{1,}[a-zA-Z -]{1,}$/'),
					'required'=> true,
					'allowEmpty' => false,
					'message' => 'Champ incorrect'
					
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
					'message'=>'Email déjà existant'
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
	
	public static function verifMotDePasse($mdp){
		$bon = true;
		//il faut 6c une Maj, une minuscule et un chiffre
		$message = "Votre mot de passe est incorrect :";
		if(strlen($mdp) < 6){
			$bon = false;
			$message .= "<br>- au moins 6 caract&egrave;re.";
		}
		if(!preg_match("#[A-Z]#",$mdp)){
			$bon = false;
			$message .= "<br>- au moins une majuscule.";
		}
		if(!preg_match("#[a-z]#",$mdp)){
			$bon = false;
			$message .= "<br>- au moins une minuscule.";
		}
		if(!preg_match("#[0-9]#",$mdp)){
			$bon = false;
			$message .= "<br>- au moins un chiffre.";
		}
		if($bon){
			return "";
		}else{
			return $message;
		}
	}
	
	public static function verifEmail($email){
		$rep = "";
		if(!preg_match("#[a-zA-Z0-9]+@[a-zA-Z0-9]+[\.][a-zA-Z]+#", $email)){
			$rep = "L'email est incorrect";
		}
		return $rep;
	}
}
?>
