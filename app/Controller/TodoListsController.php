<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

class TodoListsController extends AppController {
    public $uses = array('TodoList','Association');
    public function index(){
        $this->set('lists', $this->TodoList->find('all'));
    }
    
    public function add(){
        $user = $this->Session->read("User");
       
        
        
        
        if($this->request->is('post')){
            $this->TodoList->create();
            if ($this->TodoList->save($this->request->data)) {
                $id = $this->TodoList->find('count');
                $this->Association->create();
                $list = $this->TodoList->find('all',array('conditions'=>array('TodoList.nom =' =>$this->request->data['TodoList']['nom'])));
                $this->Association->save(array(
                    'Association' => array('id_users'=>$user['id'],'id_todo_lists'=>$id)
                    )
                        );
                $this->Session->setFlash(__('La liste a été sauvegardée'));
                return $this->redirect(array('action' => 'meslists'));
            } else {
                $this->Session->setFlash(__('La liste n\'a pas été sauvegardée. Merci de réessayer.'));
            }
        }
    }
    
    public function meslists(){
        $user = $this->Session->read("User");
        $assocs = $this->Association->find('all',array('conditions' => array('Association.id_users ='=>$user['id'])));
        $i= 0;
        $list = array();
        foreach($assocs as $assoc){
            $list[$i] = $this->TodoList->find('all',array('conditions'=>array('TodoList.id =' =>$assoc['Association']['id_todo_lists'])));
            $i++;
        }
        $this->set('lists', $list);
    }
    
    public function delete($id){
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        $user = $this->Session->read("User");
        $assocs = $this->Association->find('first',array('conditions' => array('Association.id_users ='=>$user['id'],'Association.id_todo_lists ='=>$id)));
        if($this->Association->delete($assocs['Association']['id'])){
            $this->Session->setFlash(__('La liste  a été supprimé.'));
            return $this->redirect(array('controller' => 'TodoLists','action' => 'index'));
        }
        else {
            $this->Session->setFlash('La liste n\'a pas pu être supprimé.');
        }
        
    }
}