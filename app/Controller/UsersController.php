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
					// Si on arrive � l'�crire en BDD
					if($this->User->save($d,true,array('nom','prenom','date_de_naissance','sexe','mail','mot_de_passe','photo'))){
						// On r�cup�re l'objet qu'on vient d'�crire en BDD (pour r�cup�rer son ID)
						$user = $this->User->find('first', array('conditions' => array('User.mail' => $d['User']['mail'])));
						$user=$user['User'];
						// On l'�crit en Session, l'utilisateur est maintenant inscrit ET connect�
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
		$this->set('title_for_layout', "Modifier mon profil");
		$this->set('user', $this->Session->read("User"));
		$user = $this->Session->read("User");
		if(!empty($this->data)){
			$user['nom'] = $this->data['User']['nom'];
			$user['prenom'] = $this->data['User']['prenom'];
			$datenaiss = $this->data['User']['date_de_naissance']['year'].'-'.$this->data['User']['date_de_naissance']['month'].'-'.$this->data['User']['date_de_naissance']['day'];
			$user['date_de_naissance'] = $datenaiss;
			$user['sexe'] = $this->data['User']['sexe'];
			$this->Session->write("User",$user);
			if($this->User->save($user)){
				$this->Session->setFlash("Vos modifications ont bien &eacute;t&eacute; enregistr&eacute;es","notif");
			    $this->redirect('/users/profil');
			}
			else{
				$this->Session->setFlash("Erreur");
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
