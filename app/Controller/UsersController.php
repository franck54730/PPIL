<?php
class UsersController extends AppController {
	public function index() {
		$this->redirect(array('controller' => 'users','action' => 'connect'));
	}
	
	public function connect() {
		$this->set('title_for_layout', "Connexion");
		if(!empty($this->data)){
			$connect = false;
			$i = 0;
			$users = $this->User->find('all');
			while(!$connect && $i < count($users)){
				$user = $users[$i];
				$userTab = $user["User"];
				if($userTab['mail'] == $this->data['User']['mail'] && $userTab['mot_de_passe'] == $this->data['User']['motDePasse']){
					$thisUser = $this->User->findById($userTab['id']);
					$this->Session->write("User",$thisUser["User"]);
					$connect = true;
				}
				$i++;
			}
			if($connect){
          		$this->Session->setFlash("Votre connexion a r&eacute;ussi.");
          		$this->redirect(array('controller' => 'todolists', 'action' => 'index'));
			}else{
          		$this->Session->setFlash("Votre connexion a &eacute;chou&eacute;e.");
			}
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
}
