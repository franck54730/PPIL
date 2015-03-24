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
                $list = $this->TodoList->find('all',array('conditions'=>array('TodoList.name =' =>$this->request->data['TodoList']['name'])));
                $this->Association->save(array(
                    'Association' => array('id_user'=>$user['id'],'id_todolist'=>$id)
                    )
                        );
                $this->Session->setFlash(__('La liste a été sauvegardée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La liste n\'a pas été sauvegardée. Merci de réessayer.'));
            }
        }
    }
    
    public function meslists(){
        $user = $this->Session->read("User");
        $assocs = $this->Association->find('all',array('conditions' => array('Association.id_user ='=>$user['id'])));
        $i= 0;
        $list = array();
        foreach($assocs as $assoc){
            $list[$i] = $this->TodoList->find('all',array('conditions'=>array('TodoList.id =' =>$assoc['Association']['id_todolist'])));
            $i++;
        }
        $this->set('lists', $list);
    }
}