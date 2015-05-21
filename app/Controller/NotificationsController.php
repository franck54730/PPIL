<?php
	
class NotificationsController extends AppController {
	
	public $components = array('Session');
	
	public function index() {
	  $user = $this->Session->read('User');
	  $user = $user['id'];
	  $notifs = $this->Notification->find('all', array('conditions' => array('Notification.id_utilisateur' => $user)));
	  $this->set('notifs',$notifs);
	  foreach($notifs as $notif){
	    $notif['Notification']['consulte'] = '1';
	    $this->Notification->save($notif);
	  }
	}
	
	public function createNotifItem($id_Item, $check, $id_user){
		$this->loadModel('Item');
		$this->loadModel('TodoList');
		$this->loadModel('Association');
		$this->loadModel('User');
		$user = $this->User->find('first', array('conditions' => array('User.id' => $id_user)));
		$nom_user = $user['User']['prenom'].' '.$user['User']['nom'];
		$item = $this->Item->find('first', array('conditions' => array('Item.id'=> $id_Item)));
		$nomItem = $item['Item']['nom'];
		$liste = $this->TodoList->find('first', array('conditions' => array('TodoList.id' => $item['Item']['id_todo_lists'])));	
		$users = $this->Association->find('all', array('conditions' => array(array('Association.id_todo_lists' => $liste['TodoList']['id']),array('Association.id_users !=' => $id_user))));
		if($check == 1)
			$texte = 'L\'item "'.$nomItem.'" de la liste '.$liste['TodoList']['nom'].' a &eacute;t&eacute; s&eacute;l&eacute;ctionn&eacute par '.$nom_user.'.';
		else 
			$texte = 'L\'item "'.$nomItem.'" de la liste '.$liste['TodoList']['nom'].' a &eacute;t&eacute; d&eacute;s&eacute;lectionn&eacute par '.$nom_user.'.';
		foreach($users as $user){
			$this->Notification->create();
			$this->Notification->save(array('Notification' => array('id_utilisateur' => $user['Association']['id_users'], 'id_todolist' => $item['Item']['id_todo_lists'],'texte' => $texte, 'consulte' => '0')));
		}
	}

	public function createNotifListe($id_liste, $id_user){
		$this->loadModel('TodoList');
		$this->loadModel('User');
		$this->loadModel('Association');
		$user = $this->User->find('first', array('conditions' => array('User.id' => $id_user)));
		$nom_user = $user['User']['prenom'].' '.$user['User']['nom'];
		$liste = $this->TodoList->find('first', array('conditions' => array('TodoList.id' => $id_liste)));	
		$nom_liste = $liste['TodoList']['nom'];
		$users = $this->Association->find('all', array('conditions' => array(array('Association.id_todo_lists' => $id_liste),array('Association.id_users !=' => $id_user))));
		$texte = 'La liste "'.$nom_liste.'" a &eacute;t&eacute; modifi&eacute;e par '.$nom_user;
		foreach($users as $user){
			$this->Notification->create();
			$this->Notification->save(array('Notification' => array('id_utilisateur' => $user['Association']['id_users'], 'id_todolist' => $id_liste,'texte' => $texte, 'consulte' => '0')));
		}

	}
}
