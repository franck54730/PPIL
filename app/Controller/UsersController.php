<?php
class UsersController extends AppController {
	public function index() {
		echo "toto";
		$this->redirect(array('controller' => 'users','action' => 'connect'));
	}
	
	public function connect() {
		if(!empty($this->data)){
			$connect = false;
			$i = 0;
			$users = $this->User->find('all');
			while(!$connect && $i < count($users)){
				$user = $users[$i];
				$userTab = $user["User"];
				if($userTab['mail'] == $this->data['User']['mail'] && $userTab['motDePasse'] == $this->data['User']['motDePasse']){
					$thisUser = $this->User->findById($userTab['id']);
					$this->Session->write("User",$thisUser["User"]);
					$connect = true;
				}
				$i++;
			}
			if($connect){
          		$this->Session->setFlash("Votre connexion a réussi.");
			}else{
          		$this->Session->setFlash("Votre connexion a échouée.");
			}
		}
	}

	public function deconnexion(){
		$this->Session->destroy();
		$this->redirect(array('controller' => 'users','action' => 'connect'));
	}

	public function inscription(){
		
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
							"prenom" => $this->data['User']['prenom']));
							"dateDeNaissance" => $this->data['User']['dateDeNaissance']));
							"sexe" => $this->data['User']['sexe']));
							"mail" => $this->data['User']['mail']));	
							"modDePasse" => $this->data['User']['password']));
							"photo" => $this->data['User']['photo']));
					$this->User->save($this->data);
				
					/*$id_user = count($this->User->find('all'));*/
						
					$connect = true;
					if($connect){
						
					}else{
						$this->Session->setFlash("Votre connexion a échouée.");
					}
				
				
				}else
				{
					$this->validateErrors($this->User);
				}
			}
			
		}
}
