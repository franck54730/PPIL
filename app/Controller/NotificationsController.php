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
	
	public function create($id_Item, $check){
		$this->loadModel('Item');
		$this->loadModel('TodoList');
		$this->loadModel('Association');
		$item = $this->Item->find('first', array('conditions' => array('Item.id'=> $id_Item)));
		$nomItem = $item['Item']['nom'];
		$liste = $this->TodoList->find('first', array('conditions' => array('TodoList.id' => $item['Item']['id_todo_lists'])));
		$users = $this->Association->find('all', array('conditions' => array('Association.id_todo_lists' => $liste['TodoList']['id'])));
		if($check == 1)
			$texte = 'L\'item "'.$nomItem.'" de la liste '.$liste['TodoList']['nom'].' a &eacute;t&eacute; s&eacute;l&eacute;ctionn&eacute.';
		else 
			$texte = 'L\'item "'.$nomItem.'" de la liste '.$liste['TodoList']['nom'].' a &eacute;t&eacute; d&eacute;s&eacute;lectionn&eacute.';
		foreach($users as $user){
			$this->Notification->create();
			$this->Notification->save(array('Notification' => array('id_utilisateur' => $user['Association']['id_users'], 'id_todolist' => $item['Item']['id_todo_lists'],'texte' => $texte, 'consulte' => '0')));
		}
	}
}
