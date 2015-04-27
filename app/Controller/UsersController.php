<?php
class UsersController extends AppController {
	private $salt = "5148520596358126541562158962514";
	
	public function index() {
		$this->redirect(array('controller' => 'users','action' => 'connect'));
	}
	
	public function connect() {
		$this->set('title_for_layout', "Connexion");
		$messageErreur = "Votre connexion &agrave;&nbsp;&eacute;chou&eacute; car :";
		if($this->Session->read("User") == null){
			$connect = false;
			if(!empty($this->data)){
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
							echo $userTab['mot_de_passe']."  ".Security::hash(trim($this->data['User']['motDePasse']), 'md5', $this->salt);
							if($userTab['mot_de_passe'] == Security::hash($this->data['User']['motDePasse'], 'md5', $this->salt)){
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
				$i++;
			}
			if($connect){
          		$this->Session->setFlash("Votre connexion a rÃ¯Â¿Â½ussi.");
			}else{
          		$this->Session->setFlash($messageErreur);
			}
		}else{
			$this->Session->setFlash("Vous &ecirc;tes d&eacute;j&agrave; connect&eacute;.");
	        $this->redirect('/');
		}
	}

	function signup(){
			if ($this->request->is('post')) {
				$d =$this->request->data;
				$d['User']['id'] = null;
				if (!empty($d['User']['mot_de_passe'])) {
					$d['User']['mot_de_passe'] = Security::hash(trim($d['User']['mot_de_passe']), 'md5', $this->salt);
				}
				
				if (!empty($d['User']['mail'])) {
					$this->User->save($d,true,array('nom','prenom','date_de_naissance','sexe','mail','mot_de_passe','photo'));
					$this->Session->setFlash("Votre compte à bien été crée","notif");
					$this->Auth->login($d['User']['mail']);
	        		$this->redirect('/');
				}else{
					$this->Session->setFlash("Veuillez corriger vos erreurs","notif",array('type'=>'error'));
				}
			}
		}

	public function deconnexion(){
		$this->set('title_for_layout', "Deconnexion");
		$this->Session->destroy();
		$this->redirect(array('controller' => 'users','action' => 'connect'));
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
