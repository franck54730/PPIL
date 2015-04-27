<?php
class UsersController extends AppController {
	public function index() {
		$this->redirect(array('controller' => 'users','action' => 'connect'));
	}
	
	public function connect() {
		$this->set('title_for_layout', "Connexion");
		if($this->Session->read("User") == null){
			if(!empty($this->data)){
				$connect = false;
				$messageErreur = "Votre connexion &agrave;&nbsp;&eacute;chou&eacute; car :";
				$erreur = false;
				if(strlen($this->data['User']['mail']) == 0){
					$messageErreur .= "<br> - le champ email n'a pas &eacute;t&eacute; renseign&eacute;.";
					$erreur = true;
				}
				if(strlen($this->data['User']['motDePasse']) == 0){
					$messageErreur .= "<br> - le champ mot de passe n'a pas &eacute;t&eacute; renseign&eacute;.";
					$erreur = true;
				}
				if(!$erreur){
					$trouv = false;
					$i = 0;
					$users = $this->User->find('all');
					while(!$trouv && $i < count($users)){
						$user = $users[$i];
						$userTab = $user["User"];
						if($userTab['mail'] == $this->data['User']['mail']){
							$trouv = true;
							if($userTab['mot_de_passe'] == $this->data['User']['motDePasse']){
								$thisUser = $this->User->findById($userTab['id']);
								$this->Session->write("User",$thisUser["User"]);
								$connect = true;
							}else{
								$messageErreur .= "<br> - le mot de passe est incorrect.";
							}
						}
						$i++;
					}
					if(!$trouv){
						$messageErreur .= "<br> - cette email n'est pas connu.";
					}
				}
				if($connect){
					$this->Session->setFlash("Votre connexion a r&eacute;ussi.");
					$this->redirect('/');
				}else{
					$this->Session->setFlash($messageErreur);
				}
			}
		}else{
			$this->Session->setFlash("Vous &ecirc;tes d&eacute;j&agrave; connect&eacute;.");
	        $this->redirect('/');
		}
	}

	public function deconnexion(){
		$this->set('title_for_layout', "Deconnexion");
		$this->Session->destroy();
		$this->redirect(array('controller' => 'users','action' => 'connect'));
	}

	public function inscription(){
		$this->set('title_for_layout', "Inscription");
		if(!empty($this->data))
		{
			$existe=false;
			$i = 0;
			$users = $this->User->find('all');
			while( $i < count($users)){
				$user = $users[$i];
				$userTab = $user["User"];
				if($userTab['mail'] == $this->data['User']['mail'] && !$existe){
					$this->Session->setFlash("Cet identifiant existe deja.");
					$this->redirect(array('controller' => 'users','action' => 'inscription'));
					$existe=true;
				}
				$i++;
			}
			if(!$existe){
				$this->User->set( $this->data );
				
				if( $this->User->validates() )
				{
					$connect = false;
					// on insert le new user
					$this->User->set(array(
							"nom" => $this->data['User']['nom'],
							"prenom" => $this->data['User']['prenom'],
							"date_de_naissance" => $this->data['User']['date_de_naissance'],
							"sexe" => $this->data['User']['sexe'],
							"mail" => $this->data['User']['mail'],	
							"mot_de_passe" => $this->data['User']['password'],
							"photo" => $this->data['User']['photo']));
					$this->User->save($this->data);
				
					/*$id_user = count($this->User->find('all'));*/
						
					$connect = true;
					if($connect){
						
					}else{
						$this->Session->setFlash("Votre inscription a �chou�e.");
					}
				
				
				}else
				{
					$this->validateErrors($this->User);
				}
			}
			
		}
	}

	public function profil(){
		$this->set('user', $this->Session->read("User"));
		$this->set('title_for_layout', "Mon Compte");
	}
	
	public function edit(){
		$this->set('title_for_layout', "Modifier mon compte");
		$this->set('user', $this->Session->read("User"));
	}
	
	public function association_facebook(){
		if(!empty($this->request->query['id']))
		{
			$user = $this->Session->read("User");
			$user['id_facebook'] = $this->request->query['id'];
			$this->Session->write("User",$user);
			$this->User->save($user);
		}
	}
}
