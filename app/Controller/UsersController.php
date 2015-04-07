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
				if($userTab['mail'] == $this->data['User']['mail'] && $userTab['mot_de_passe'] == $this->data['User']['motDePasse']){
					$thisUser = $this->User->findById($userTab['id']);
					$this->Session->write("User",$thisUser["User"]);
					$connect = true;
				}
				$i++;
			}
			if($connect){
          		$this->Session->setFlash("Votre connexion a r�ussi.");
			}else{
          		$this->Session->setFlash("Votre connexion a �chou�e.");
			}
		}
	}

	function signup(){
			if ($this->request->is('post')) {
				$d =$this->request->data;
				$d['User']['id'] = null;
				if (!empty($d['User']['mot_de_passe'])) {
					$d['User']['mot_de_passe'] = Security::hash($d['User']['mot_de_passe']);
				}
				if ($this->User->save($d,true,array('nom','prenom','date_de_naissance','sexe','mail','mot_de_passe','photo'))) {
					/*$link = array('controller'=>'user','action'=>'activate',$this->User->id.'_'.md5($d['User']['mot_de_passe']));
					App::uses('CakeEmail','Network/Email');
					$mail = new CakeEmail();
					$mail->from('noreply@localhost.com')
						->to($d['User']['mail'])
						->subject('Inscription')
						->emailFormat('html')
						->template('signup')
						->viewVars(array('nom'=>$d['User']['nom'],'prenom'=>$d['User']['prenom'],'link'=>$link))
						->send();*/
				$this->Session->setFlash("Votre compte � bien �t� cr�","notif");
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
							"date_de_naissance" => $this->data['User']['date_de_naissance'],
							"sexe" => $this->data['User']['sexe'],
							"mail" => $this->data['User']['mail'],	
<<<<<<< HEAD
							"modDePasse" => $this->data['User']['mot_de_passe'],
=======
							"mot_de_passe" => $this->data['User']['password'],
>>>>>>> 59208f003412915dbbe2a79a9b03a72c933b1f64
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
}
