<?php

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
                $this->Session->setFlash(__('Vous avez oublié de remplir le nom'));
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
                    $this->Session->setFlash(__('La liste a été sauvegardée'));
                    
                    return $this->redirect(array('controller' => 'Items','action' => 'seeList/'.$id));
                } else {
                    $this->Session->setFlash(__('La liste n\'a pas été sauvegard&eacute;e. Merci de r&eacute;essayer.'));
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
        foreach ($assocs as $assoc) {
        	
        	//$arrayitems[$i][0] = $list['id']; 
            $list[$i] = $this->TodoList->find('all', array('conditions' => array('TodoList.id =' => $assoc['Association']['id_todo_lists'])));
           
            $i++;
        }
        $j = 0;
        $assocs = $this->TodoList->find('all');
        foreach($assocs as $assoc){
        	$j++;
        }
        for($x=0; $x<$i;$x++){
        	$id_todo_lists[$x] = $list[$x][0]['TodoList']['id'];
        }
        //print $i;
       //print $j;
        
        $this->loadModel('Item');
        for($x=0; $x<=$j;$x++){
        	//print $x;
        	$items[$x]= $this->Item->find('all', array('conditions' => array('Item.id_todo_lists' => $x)));
        	
        	
        }
        print_r($items);
        foreach($items as $item){
        	$arrayitems[$item['id_todo_lists']][$item['id']]=$item;
        }
        
        
        
        
        $this->set('lists', $list);
    }

    public function delete($id) {
        $this->set('title_for_layout', "Supprimer une liste");
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        $user = $this->Session->read("User");
        $assocs = $this->Association->find('first', array('conditions' => array('Association.id_users =' => $user['id'], 'Association.id_todo_lists =' => $id)));
        if ($this->Association->delete($assocs['Association']['id'])) {
            $this->Session->setFlash(__('La liste  a &eacute;t&eacute; supprim&eacute;e.'));
            return $this->redirect(array('controller' => 'TodoLists', 'action' => 'meslists'));
        } else {
            $this->Session->setFlash('La liste n\'a pas pu être supprimé.');
        }
    }

    public function modif() {

        $this->set('title_for_layout', "Modifier une liste");
        $nouvelle = $this->data;

        $vielle = $this->TodoList->find('first', Array('condition' => Array('TodoList.id' => $nouvelle['TodoList']['id'])));

        if ($vielle != null) {

            $this->TodoList->save(array(
                'TodoList' => array('id' => $nouvelle['TodoList']['id'], 
                    'nom' => $nouvelle['TodoList']['nom'], 
                    'date' => $nouvelle['TodoList']['date'], 
                    'frequence'=>$nouvelle['TodoList']['frequence'], 
                    'unite_frequence'=>$nouvelle['TodoList']['unite_frequence'], 
                    'date_fin'=>$nouvelle['TodoList']['date_fin'])
                    )
            );
            $this->Session->setFlash('La liste a pas pu être modifiée.');
            return $this->redirect(array('controller' => 'Items', 'action' => 'seeList/' . $nouvelle['TodoList']['id']));
            
        } else {
            $this->Session->setFlash('La liste n\'a pas pu être trouv&eacute;e.');
        }
    }

    public function alter($id) {
        $list = $this->TodoList->find('first', Array('conditions' => Array('TodoList.id' => $id)));
        $this->set('to', $this->TodoList->find('first', Array('conditions' => Array('TodoList.id' => $id))));
        $this->loadModel('Item');
        $this->set('it',$this->Item->find('all', array('conditions' => array('Item.id_todo_lists' => $id))));
    }

    public function seeList($id){
    	return $this->redirect(array('controller' => 'Items', 'action' => 'seeList/' . $id));
    	//$list = $this->Item->find('all', array('conditions' => array('Item.id_todo_lists' => $id)));
    	//$this->set('to', $this->Item->find('first', Array('conditions' => array('Item.id_todo_lists' => $id))));
    	//echo $list['Item']['nom'];
    }
}