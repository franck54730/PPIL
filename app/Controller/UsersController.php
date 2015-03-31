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

	function signup(){
			if ($this->request->is('post')) {
				$d =$this->request->data;
				$d['User']['id'] = null;
				if (!empty($d['User']['password'])) {
					$d['User']['password'] = Security::hash($d['User']['password']);
				}

				if ($this->User->save($d,true,array('nom','prenom','date_de_naissance','sexe','mail','password','photo'))) {
					/*$link = array('controller'=>'user','action'=>'activate',$this->User->id.'_'.md5($d['User']['password']));
					App::uses('CakeEmail','Network/Email');
					$mail = new CakeEmail();
					$mail->from('noreply@localhost.com')
						->to($d['User']['mail'])
						->subject('Inscription')
						->emailFormat('html')
						->template('signup')
						->viewVars(array('nom'=>$d['User']['nom'],'prenom'=>$d['User']['prenom'],'link'=>$link))
						->send();*/
				$this->Session->setFlash("Votre compte à bien été cré","notif");
				$this->Auth->login($d['User']['mail']);
				}else{
					$this->Session->setFlash("Veuillez corriger vos erreurs","notif",array('type'=>'error'));
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
							"prenom" => $this->data['User']['prenom'],
							"dateDeNaissance" => $this->data['User']['dateDeNaissance'],
							"sexe" => $this->data['User']['sexe'],
							"mail" => $this->data['User']['mail'],	
							"modDePasse" => $this->data['User']['password'],
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
}
