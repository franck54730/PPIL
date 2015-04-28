<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ItemsController extends AppController {

    public function index() {
    	$this->set('title_for_layout', "Mes Items");
    	$this->set('items', $this->Item->find('all'));
    }


    public function add($list,$id) {
        $this->set('nom', $list);
        $this->set('id', $id);
        if ($this->request->is('post')) {

          //  echo "fvsdgk";
        }
    }
    

   

    public function ajoutItem() {

        if ($this->request->is('post')) {
            if ($this->request->data['Item']['nom'] == '') {
                $this->Session->setFlash(__('Vous avez oublié de remplir le nom'));
            } else {
                $this->Item->create();
                if ($this->Item->save($this->request->data)) {
                    
                } else {
                    $this->Session->setFlash(__('echec de la reation de l\'item'));
                }
            }
        }
        return $this->redirect(array('controller' => 'TodoLists', 'action' => 'alter/'.$this->data['Item']['id_todo_lists']));
    }
    
    
    
    public function delete($id) {
    	$this->set('title_for_layout', "Supprimer un item");
    	if ($this->request->is('get')) {
    		throw new MethodNotAllowedException();
    	}
    	$user = $this->Session->read("User");
    	if ($this->Item->delete($id)) {
    		$this->Session->setFlash(__('L item  a &eacute;t&eacute; supprim&eacute;e.'));
    		//return $this->redirect(array('controller' => 'Items', 'action' => 'seeList'));
    	} else {
    		$this->Session->setFlash('L item n\'a pas pu être supprimé.');
    	}
    }
    
    
    
    
    public function seeList($id){
    	//$lists = $this->Item->find('all');
    	
    	$lists = $this->Item->find('all', array('conditions' => array('Item.id_todo_lists' => $id)));
    	//$this->set('lists', $this->Item->find('first', Array('conditions' => array('Item.id_todo_lists' => $id))));
    	$this->set('lists', $lists);
    	//echo $lists['Item']['nom'];
    }
    
    public function alter($id,$id_todolist) {
        
        $lists = $this->Item->find('first', array('conditions' => array('Item.id' => $id)));
        $this->set('id', $id);
        $this->set('nom',$lists['Item']['nom']);
        $this->set('id_todolist',$id_todolist);
        
        if ($this->request->is('post')) {
        }
    }
    
    public function modif($id,$id_todolist){
        $this->set('title_for_layout', "Modifier une liste");
        $nouvelle = $this->data;
        
        $vielle = $this->Item->find('first', Array('condition' => Array('Item.id' => $id)));
        
        if ($vielle != null) {
        
            $this->Item->save(array(
                    'Item' => array('id' => $id,
                            'nom' => $nouvelle['Item']['nom']
            )
            ));
            return $this->redirect(array('controller' => 'Items', 'action' => 'seeList/'.$id_todolist));
        } else {
            $this->Session->setFlash('L\'item n\'a pas pu être trouv&eacute;e.');
        }
    }

}
