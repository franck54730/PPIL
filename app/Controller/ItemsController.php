<?php

class ItemsController extends AppController {

    public function index() {
    	$this->set('title_for_layout', "Mes Items");
    	$this->set('items', $this->Item->find('all'));
    }

    public function add($list,$id) {
        $this->set('nom', $list);
        $this->set('id', $id);
        if ($this->request->is('post')) {

        }
    }

    public function ajoutItem() {

        if ($this->request->is('post')) {
            if ($this->request->data['Item']['nom'] == '') {
                $this->Session->setFlash(__('Vous avez oubli&eacute; de remplir le nom'));
            } else {
                $this->Item->create();
                if ($this->Item->save($this->request->data)) {
                    
                } else {
                    $this->Session->setFlash(__('echec de la cr&eacute;ation de l\'item'));
                }
            }
        }
        return $this->redirect(array('controller' => 'TodoLists', 'action' => 'meslists'));
    }
    
    
    
    public function delete($id) {
    	$this->set('title_for_layout', "Supprimer un item");
    	if ($this->request->is('get')) {
    		throw new MethodNotAllowedException();
    	}
    	$user = $this->Session->read("User");
    	if ($this->Item->delete($id)) {
    		$this->Session->setFlash(__('L`\'item  a &eacute;t&eacute; supprim&eacute;.'));
    		return $this->redirect(array('controller' => 'TodoLists', 'action' => 'meslists'));
    	} else {
    		$this->Session->setFlash('L item n\'a pas pu &ecirc;tre supprim&eacute;.');
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
        
    }
    
    //fonction de gestion du cochage/décochage d'un item d'une liste
    public function check($id) {
    	$lists = $this->Item->find('first', array('conditions' => array('Item.id' => $id)));
    	$check = $this->data;
    	$coche = $check['Item']['checked'];
        $id_user = $this->Session->read('User')['id'];
    
        App::import('Controller', 'Notifications');
        $notification = new NotificationsController;
    	if($coche != "0"){
    		//cochage
    		$this->Item->save(array('Item' => array('id' => $id, 'checked' => '1')));
            $notification->create($id,1,$id_user);
    	}else{
    		//décochage
    		$this->Item->save(array('Item' => array('id' => $id, 'checked' => '0')));
            $notification->create($id,0,$id_user);
    	}
    	
		
    	//redirection 
    	return $this->redirect(array('controller' => 'TodoLists', 'action' => 'meslists'));
    	
    }
    
    public function modif($id,$id_todolist){
        $this->set('title_for_layout', "Modifier une liste");
        $nouvelle = $this->data;
        
        $vielle = $this->Item->find('first', Array('condition' => Array('Item.id' => $id)));
        
        $chaine = $nouvelle['Item']['nom'];
        $chaine = trim($chaine);
        if(strlen($chaine)!=0){
        	if ($vielle != null) {
        	
        		if($this->Item->save(array(
        				'Item' => array('id' => $id,
        						'nom' => $nouvelle['Item']['nom']
        				)
        		))){
					$this->Session->setFlash('L\'item a &eacute;t&eacute; modifi&eacute;.');
					return $this->redirect(array('controller' => 'TodoLists', 'action' => 'meslists'));
				}else{
					$this->Session->setFlash('L\'item n\'a pas &eacute;t&eacute; modifi&eacute;.');
				}
        		
        	} else {
        		$this->Session->setFlash('L\'item n\'a pas pu Ãªtre trouv&eacute;e.');
        	}
        }else{
        	$this->Session->setFlash('Le champ ne dois pas Ãªtre vide.');
        	return $this->redirect(array('controller' => 'Items', 'action' => 'alter/'.$id.'/'.$id_todolist));
        }
        
    }

}
