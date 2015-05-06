<?php
class UsersController extends AppController {
	private $salt = "5148520596358126541562158962514";
	
	public function index() {
		$this->redirect(array('controller' => 'users','action' => 'connect'));
	}
	
	public function connect() {
		$this->set('title_for_layout', "Connexion");
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
								$messageErreur = "<br> Identifiants de connexion incorrects";
							}
						}
						$i++;
					}
					if(!$trouv){
						$messageErreur = "<br> Identifiants de connexion incorrects";
					}
				}
				if($connect){
					$this->Session->setFlash("Votre connexion a r&eacute;ussi.");
					$this->redirect('/');
				}else{
					$this->Session->setFlash($messageErreur);
				}
				$i++;
				if($connect){
	          		$this->Session->setFlash("Votre connexion a r&eacute;ussi.");
				}else{
	          		$this->Session->setFlash($messageErreur);
				}
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
			// Si le mot de passe n'est pas vide et que les 2 mots de passes concordent
			if (!empty($d['User']['mot_de_passe']) && $d['User']['mot_de_passe'] == $d['User']['mot_de_passe_verif']) {
				$d['User']['mot_de_passe'] = Security::hash(trim($d['User']['mot_de_passe']), 'md5', $this->salt);
				// Si le mail n'est pas vide
				if (!empty($d['User']['mail'])) {
					// Si on arrive à l'écrire en BDD
					if($this->User->save($d,true,array('nom','prenom','date_de_naissance','sexe','mail','mot_de_passe','photo'))){
						// On récupère l'objet qu'on vient d'écrire en BDD (pour récupérer son ID)
						$user = $this->User->find('first', array('conditions' => array('User.mail' => $d['User']['mail'])));
						$user=$user['User'];
						// On l'écrit en Session, l'utilisateur est maintenant inscrit ET connecté
						$this->Session->write("User",$user);
						$this->Session->setFlash("Votre compte a bien &eacute;t&eacute; cr&eacute;e","notif");
		        		$this->redirect('/');
		        	}
		        	else{
		        		$this->Session->setFlash("Email existant");
		        	}
				}else{
					$this->Session->setFlash("Veuillez corriger vos erreurs","notif",array('type'=>'error'));
				}
			}
			else{
				$this->Session->setFlash("Les 2 mots de passe ne correspondent pas");
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
