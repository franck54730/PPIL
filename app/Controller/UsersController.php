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
}
