<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

class TodoListsController extends AppController {
    
    public function index(){
        $this->set('lists', $this->TodoList->find('all'));
    }
    
    public function add(){
        if($this->request->is('post')){
            $this->TodoList->create();
            if ($this->TodoList->save($this->request->data)) {
                $this->Session->setFlash(__('La liste a été sauvegardée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La liste n\'a pas été sauvegardée. Merci de réessayer.'));
            }
        }
    }
}