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
		$this->loadModel("User");
		if($this->Session->read("User") == null){
			if ($this->request->is('post')) {
				$d =$this->request->data;
				$d['User']['id'] = null;
				$jour = $d['User']['date_de_naissance']['day'];
				$mois = $d['User']['date_de_naissance']['month'];
				$annee = $d['User']['date_de_naissance']['year'];
				// on verifie le mot de passe 
				$message = User::verifMotDePasse($d['User']['mot_de_passe']);
				if($message == ""){
					// Si le mot de passe n'est pas vide et que les 2 mots de passes concordent
					if (!empty($d['User']['mot_de_passe']) && $d['User']['mot_de_passe'] == $d['User']['mot_de_passe_verif']) {
						$d['User']['mot_de_passe'] = Security::hash(trim($d['User']['mot_de_passe']), 'md5', $this->salt);
						// Si le mail n'est pas vide
						if (!empty($d['User']['mail'])) {
							if(checkdate($mois,$jour,$annee)){
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
					        		$this->Session->setFlash("Donnez un email correct");
					        	}
				        	}else{
				        		$this->Session->setFlash("La date n'est pas correcte.");
				        	}
				        }else{
				        	$this->Session->setFlash("Donnez un email.");
				        }
					}else{
						$this->Session->setFlash("Les 2 mots de passe ne correspondent pas");
					}
				}else{
					$this->Session->setFlash($message);
				}
			}else{
	
			}
		}else{
				$this->Session->setFlash("Vous &ecirc;tes d&eacute;j&agrave; connect&eacute;.");
				$this->redirect('/TodoLists/meslists');
		}
	}
	
	public function deconnexion(){
		$this->set('title_for_layout', "Deconnexion");
		$this->Session->destroy();
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
}
