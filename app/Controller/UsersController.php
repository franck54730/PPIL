<?php
class UsersController extends AppController {
	private $salt = "5148520596358126541562158962514";
	
	public function index() {
		$this->redirect(array('controller' => 'users','action' => 'connect'));
	}
        
        public function liste_profil(){
                $this->set('title_for_layout', "Liste des Profils");
                $users = $this->User->find('all');
                $this->set('utilisateurs',$users);
            
        }
        
        public function voir($id){
            if($this->request->is('post')){
                $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
                $this->set('utilisateur',$user['User']);
            }
        }
	
	public function connect() {
		$this->set('title_for_layout', "Connexion");
		if($this->Session->read("User") == null){
			if(!empty($this->data)){
				if(empty($this->data['User']['mail']) || empty($this->data['User']['motDePasse'])){
					$this->Session->setFlash("Identifiants de connexion incorrects");
				}
				else{
					$user = $this->User->find('first', array('conditions' => array('User.mail' => $this->data['User']['mail'])));
					if(!empty($user)){
						$user=$user['User'];
						if($user['mot_de_passe'] == Security::hash($this->data['User']['motDePasse'], 'md5', $this->salt)){
							$this->Session->write("User",$user);
							$this->Session->setFlash("Connexion r&eacute;ussie");
							$this->redirect('/');
						}
						else{
							$this->Session->setFlash("Identifiants de connexion incorrects");
						}
					}
					else{
						$this->Session->setFlash("Identifiants de connexion incorrects");
					}
				}
			}
		}else{
			$this->Session->setFlash("Vous &ecirc;tes d&eacute;j&agrave; connect&eacute;.");
			$this->redirect('/TodoLists/meslists');
		}
	}

	function signup(){
		$erreur = false;
		$messageErreur = array();
		$this->loadModel("User");
		if($this->Session->read("User") == null){
			if ($this->request->is('post')) {
				$d =$this->request->data;
				$d['User']['id'] = null;
				$jour = $d['User']['date_de_naissance']['day'];
				$mois = $d['User']['date_de_naissance']['month'];
				$annee = $d['User']['date_de_naissance']['year'];
				
				//verification du nom
				if(strlen($d['User']['nom'])==0){
					$erreur = true;
					$messageErreur['nom'] = "Le nom est vide.";
				}
				//verification du prenom			
				if(strlen($d['User']['prenom'])==0){
					$erreur = true;
					$messageErreur['prenom'] = "Le pr&eacute;nom est vide.";
				}		
				//verification de la date
				if(!checkdate($mois,$jour,$annee)){
					$erreur = true;
					$messageErreur['date'] = "La date n'&eacute;xiste pas.";
				}
				//verifiacation de l'email			
				if(strlen($d['User']['mail'])==0){
					$erreur = true;
					$messageErreur['mail'] = "L'email est vide.";
				}else {
					$mess = User::verifEmail($d['User']['mail']);
					if($mess != ""){
						$erreur = true;
						$messageErreur['mail'] = $mess;
					}
				}
				//verification du mot de passe
				$mess = User::verifMotDePasse($d['User']['mot_de_passe']);
				if($mess != ""){
					$erreur = true;
					$messageErreur['mot_de_passe'] = $mess;
				}else{
					if($d['User']['mot_de_passe'] != $d['User']['mot_de_passe_verif']){
						$erreur = true;
						$messageErreur['mot_de_passe_verif'] = "Les deux mots de passe doivent &ecirc;tre identique.";
					}
				}
				//verification de l'extension du fichier
				$jpg = preg_match("#.+[\.]jpg#",$d['User']['photo_file']['name']);
				$png = preg_match("#.+[\.]png#",$d['User']['photo_file']['name']);
				if(!$jpg && !$png){
					$erreur = true;
					$messageErreur['photo'] = "Format incorect.";
				}
				if(!$erreur){
					$this->set('erreur', $erreur);
					$this->set('messageErreur', $messageErreur);
					$d['User']['mot_de_passe'] = Security::hash(trim($d['User']['mot_de_passe']), 'md5', $this->salt);
					// Si on arrive � l'�crire en BDD
					if($this->User->save($d,true,array('nom','prenom','date_de_naissance','sexe','mail','mot_de_passe','photo'))){
						// On r�cup�re l'objet qu'on vient d'�crire en BDD (pour r�cup�rer son ID)
						$user = $this->User->find('first', array('conditions' => array('User.mail' => $d['User']['mail'])));
						$user=$user['User'];
						// On l'�crit en Session, l'utilisateur est maintenant inscrit ET connect�
						$this->Session->write("User",$user);
						$this->Session->setFlash("Votre compte a bien &eacute;t&eacute; cr&eacute;&eacute","notif");
						$this->redirect('/');
					}else{

						$this->Session->setFlash("Erreur lors de l'inscription","notif");
					}
				}else{
					$this->set('erreur', $erreur);
					$this->set('messageErreur', $messageErreur);
				}
			}else{
				$this->set('erreur', $erreur);
				$this->set('messageErreur', $messageErreur);
			}
		}else{
			$this->Session->setFlash("Vous &ecirc;tes d&eacute;j&agrave; connect&eacute;.");
			$this->redirect('/TodoLists/meslists');
		}
	}
	
	public function deconnexion(){
		$this->set('title_for_layout', "Deconnexion");
		
		$this->Session->destroy();
		$this->Session->setFlash("Vous vous &ecirc;tes d&eacute;connect&eacute;(e)");
		$this->redirect(array('controller' => 'users','action' => 'connect'));
		
	}

	public function delete(){
		$this->loadModel('Notification');
		$this->loadModel('Association');
		if(!empty($this->data['User']['mot_de_passe'])){
			$mdp = Security::hash(trim($this->data['User']['mot_de_passe']), 'md5', $this->salt);
			$user = $this->Session->read("User");
			$user2 = $this->User->find('first', array('conditions' => array('User.id' => $user['id'])));
			if($user['mot_de_passe'] == $mdp){
				$id = $user['id'];
				$this->Association->deleteAll(array('id_users' => $id));
				$this->Notification->deleteAll(array('id_utilisateur' => $id));
				$this->User->deleteAll(array('id' => $user['id']));
				$this->Session->destroy();
				$this->redirect(array('controller' => 'users','action' => 'connect'));
				$this->Session->setFlash("Votre compte a &eacute;t&eacute; supprim&eacute;");
			}
			else{
				$this->Session->setFlash("Le mot de passe est incorrect.");
			}			
		}
		else{
			$this->Session->setFlash("Le champ mot de passe est vide.");
		}

	}

	public function profil(){
		$this->set('user', $this->Session->read("User"));
		$this->set('title_for_layout', "Mon Compte");
	}
	
	public function edit(){
			$this->set('title_for_layout', "Modifier mon profil");
			$this->set('user', $this->Session->read("User"));
			$user = $this->Session->read("User");


			if(!empty($this->data)){
				$user['nom'] = $this->data['User']['nom'];
				$user['prenom'] = $this->data['User']['prenom'];

				$jour = $this->data['User']['date_de_naissance']['day'];
				$mois = $this->data['User']['date_de_naissance']['month'];
				$annee = $this->data['User']['date_de_naissance']['year'];
				$datenaiss = $annee.'-'.$mois.'-'.$jour;
				$user['date_de_naissance'] = $datenaiss;
				$user['sexe'] = $this->data['User']['sexe'];
				if(checkdate($mois, $jour, $annee)){
					$this->Session->write("User",$user);
					if($this->User->save($user)){
						$this->Session->setFlash("Vos modifications ont bien &eacute;t&eacute; enregistr&eacute;es","notif");
					    $this->redirect('/users/profil');
					}
					else{
						$this->Session->setFlash("Erreur lors de la modification de vos donn&eacute;es.");
					}
				}
				else{
					$this->Session->setFlash("La date n'est pas correcte.");
				}
			}
		
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
	
	public function dissociation_facebook(){
		$user = $this->Session->read("User");
		$user['id_facebook'] = "0";
		$this->Session->write("User",$user);
		$this->User->save($user);
	}

	public function chercher_profils($texte){
		$users = $this->User->find('all', 
			array('conditions' => 
				array('OR' =>
					array('User.nom LIKE'=> '%'.$texte.'%',
						'User.prenom LIKE'=> '%'.$texte.'%',
						'User.mail LIKE'=> '%'.$texte.'%'))));
		$this->set('users', $users);
	}
}
