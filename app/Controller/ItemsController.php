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
        echo "nom de la liste ".$list ;
        echo "id de la liste ".$id ;
        $this->set('nom', $list);
        $this->set('id', $id);
        if ($this->request->is('post')) {

          //  echo "fvsdgk";
        }
    }

    public function ajoutItem() {

        if ($this->request->is('post')) {
            echo " liste recu";
            if ($this->request->data['Item']['nom'] == '') {
                $this->Session->setFlash(__('Vous avez oublié de remplir le nom'));
            } else {
                $this->Item->create();
                if ($this->Item->save($this->request->data)) {
                    
                }else{
                    $this->Session->setFlash(__('echec de la reation de l\'item'));
                }
            }
        }
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

}
