<?php


use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\GraphObject;
use Facebook\GraphUser;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

class TodoListsController extends AppController {

    public $uses = array('TodoList', 'Association', 'User');

    public function index() {
        $this->set('title_for_layout', "Mes Listes");
        $this->set('lists', $this->TodoList->find('all'));
    }

    public function add() {
        $this->set('title_for_layout', "Nouvelle Liste");
        $user = $this->Session->read("User");
        if ($this->request->is('post')) {
            if ($this->request->data['TodoList']['nom'] == '') {
                $this->Session->setFlash(__('Vous avez oubli&eacute; de remplir le nom'));
            } else {
                $this->TodoList->create();
                if ($this->TodoList->save($this->request->data)) {
                    $id = $this->TodoList->find('count');
                    $this->Association->create();
                    $this->Association->save(array(
                        'Association' => array('id_users' => $user['id'], 'id_todo_lists' => $id)
                            )
                    );
                    if($this->request->data['TodoList']['amis']!=""){
                        $amis = $this->request->data['TodoList']['amis'];
                        foreach($amis as $ami){
                             $friend = $this->User->find('first', array('conditions' => array('User.id_facebook =' => $ami)));
                             if ($friend != null) {
                                  $this->Association->create();
                                  $this->Association->save(array(
                                    'Association' => array('id_users' => $friend['User']['id'], 'id_todo_lists' => $id)
                                ));
                             }
                        }
                    }
                    
                    $this->loadModel('Item');
                    //Ajout items
                    if($this->request->data['TodoList']['item']!=""){
                    	$items = $this->request->data['TodoList']['item'];
                    	foreach($items as $item){
	                		$this->Item->create();
	               			$this->Item->save(array(
	                    					'Item' => array('nom' => $item, 'id_todo_lists' => $id)
	                    			));
                    	}
                    }
                    
                    
                    
                    $this->Session->setFlash(__('La liste a &eacute;t&eacute; sauvegard&eacute;e'));
                    
                    return $this->redirect(array('controller' => 'TodoLists','action' => 'meslists'));
                } else {
                    $this->Session->setFlash(__('La liste n\'a pas &eacute;t&eacute; sauvegard&eacute;e. Merci de r&eacute;essayer.'));
                }
            }
        }
    }

    public function meslists() {
        $this->set('title_for_layout', "Mes Listes");
        $user = $this->Session->read("User");
        $assocs = $this->Association->find('all', array('conditions' => array('Association.id_users =' => $user['id'])));
        $i = 0;
        $list = array();
        $listId=array();
        foreach ($assocs as $assoc) {
            $list[$i] = $this->TodoList->find('all', array('conditions' => array('TodoList.id =' => $assoc['Association']['id_todo_lists'])));
            $listId[]=$list[$i][0]['TodoList']['id'];
            $i++;
        }
        $this->loadModel('Item');
        $items = $this->Item->find('all');
        $arrayitems = array();
        foreach($listId as $idTodo){
        	$array = array();
        	foreach($items as $item){
        		if($item['Item']['id_todo_lists'] == $idTodo)
        			$array[$item['Item']['id']] = $item['Item'];
        	}
        	$arrayitems[$idTodo]=$array;
        }
        $this->set('lists', $list);
        $this->set('arrayitems', $arrayitems);
    }

    public function delete($id=null) {
        $this->set('title_for_layout', "Supprimer une liste");
        if ($this->request->is('get')) {
            $this->Session->setFlash('Pour supprimer une liste, il faut le faire sur la page de la liste, petit voyou.');
            
        }else{
            $user = $this->Session->read("User");
            $assocs = $this->Association->find('first', array('conditions' => array('Association.id_users =' => $user['id'], 'Association.id_todo_lists =' => $id)));
            if ($this->Association->delete($assocs['Association']['id'])) {
                $this->Session->setFlash(__('La liste  a &eacute;t&eacute; supprim&eacute;e.'));
                return $this->redirect(array('controller' => 'TodoLists', 'action' => 'meslists'));
            } else {
                $this->Session->setFlash('La liste n\'a pas pu être supprim&eacute;e.');
            }
        }
    }

    public function modif() {
        App::import('Controller', 'Notifications');
        $notification = new NotificationsController;
        if($this->request->is("post")){
            $this->set('title_for_layout', "Modifier une liste");
            $nouvelle = $this->data;

            $vielle = $this->TodoList->find('first', Array('condition' => Array('TodoList.id' => $nouvelle['TodoList']['id'])));

            if ($vielle != null) {

                if($this->TodoList->save(array(
                    'TodoList' => array('id' => $nouvelle['TodoList']['id'], 
                        'nom' => $nouvelle['TodoList']['nom'], 
                        'date' => $nouvelle['TodoList']['date'], 
                        'frequence'=>$nouvelle['TodoList']['frequence'], 
                        'unite_frequence'=>$nouvelle['TodoList']['unite_frequence'], 
                        'date_fin'=>$nouvelle['TodoList']['date_fin'])
                        )))
                {
                    $id = $nouvelle['TodoList']['id'];
                    $id_user = $this->Session->read('User')['id'];
                    $notification->createNotifListe($id,$id_user);
    				$this->Session->setFlash('La liste a été modifi&eacute;e.');
    				return $this->redirect(array('controller' => 'TodoLists', 'action' => 'meslists'));
    			}else{
    				$this->Session->setFlash('La liste n\'a pas pu être modifi&eacute;e.');
                }
                
            } else {
                $this->Session->setFlash('La liste n\'a pas pu être trouv&eacute;e.');
            }
        }else{
            $this->Session->setFlash("Tu n'as pas le droit de faire ceci.");
        }
    }
    
    public function alter($id=null) {
        if($id == null){
            $this->Session->setFlash("Il manque le paramètre");
        }else{
            if($this->request->is("post")){
                $list = $this->TodoList->find('first', Array('conditions' => Array('TodoList.id' => $id)));
                $this->set('to', $this->TodoList->find('first', Array('conditions' => Array('TodoList.id' => $id))));
                $this->loadModel('Item');
                $this->set('it',$this->Item->find('all', array('conditions' => array('Item.id_todo_lists' => $id))));
                
                //recuperation des amis fb
                $user = $this->Session->read("User");
                $amisFacebook = array();
                if($user["id_facebook"]!=0){
                	$session = FacebookSession::setDefaultApplication('795142420534653', '4d3da35606e8450794bbeb3e7492c4c8');
                	$facebookRedirect = Router::url('/users/edit', true);
                	$helper = new FacebookRedirectLoginHelper($facebookRedirect);
                	$session = FacebookSession::newAppSession();
                
                	try{
                		$session->validate();
                	}catch (FacebookRequestException $ex){
                		echo $ex->getMessage();
                	}catch (\Exception $ex) {
                		echo $ex->getMessage();
                	}
                	$request = new FacebookRequest( $session, 'GET', '/'.$user['id_facebook'].'/friends' );
                	$response = $request->execute();
                	$users = $response->getGraphObject();
                	$data = $users->asArray();
                	$data = $data["data"];
                	$i=0;
                	foreach($data as $test){
                		$ami = $this->User->find('first', array('conditions' => array('User.id_facebook' => $test->id)));
                		if(!empty($ami)){
                			$amiTab = array();
                			$amiTab['name'] = $test->name;
                			$amiTab['id_facebook'] = $test->id;
                			$amiTab['id'] = $ami['User']['id'];
                			$assoc = $this->Association->find('first', Array('conditions' => Array('Association.id_todo_lists' => $id, 'id_users'=> $amiTab['id'])));
                			if(!empty($assoc))
                				$amiTab['associer'] = true;
                			else{
                				$amiTab['associer'] = false;
                			}
                			$amisFacebook[] = $amiTab;
                		}
                		$i++;
                	}
                }
                $this->set('amis',$amisFacebook);
            }else{
                $this->Session->setFlash('Pour modifier une liste, il faut le faire sur la page de la liste, petit voyou.');
            }
       }
    }
    
    public function check($id_todo_list, $id_user, $check){
    	if($check == 1)
    		$this->redirect(array('controller' => 'TodoLists', 'action' => 'addUser', $id_todo_list, $id_user));
    	else
    		$this->redirect(array('controller' => 'TodoLists', 'action' => 'removeUser', $id_todo_list, $id_user));
    }
    
    public function addUser($id_todo_list, $id_user){
    	$this->loadModel('Association');
    	$this->Association->create();
    	if($this->Association->save(array(
    			'Association' => array('id_users' => $id_user, 'id_todo_lists' => $id_todo_list)
    	))){
        	$this->Session->setFlash("L'utilisateur &agrave; &eacute;t&eacute; ajout&eacute; avec succes");
    	}else{
    		$this->Session->setFlash("L'utilisateur n'a pas pu &eacute;tre retir&eacute;");
    	}
    	return $this->redirect(array('controller' => 'TodoLists', 'action' => 'meslists'));
    }

    public function removeUser($id_todo_list, $id_user){
    	$this->loadModel('Association');
    	$this->Association->deleteAll(array('id_todo_lists' => $id_todo_list, 'id_users'=> $id_user));
        $this->Session->setFlash("L'utilisateur &agrave; &eacute;t&eacute; retir&eacute; avec succes");
        return $this->redirect(array('controller' => 'TodoLists', 'action' => 'meslists'));
    }

    public function seeList($id){
    	return $this->redirect(array('controller' => 'Items', 'action' => 'seeList/' . $id));
    	//$list = $this->Item->find('all', array('conditions' => array('Item.id_todo_lists' => $id)));
    	//$this->set('to', $this->Item->find('first', Array('conditions' => array('Item.id_todo_lists' => $id))));
    	//echo $list['Item']['nom'];
    }
}