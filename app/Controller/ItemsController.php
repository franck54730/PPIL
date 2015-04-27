<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ItemsController extends AppController {

    public function index() {
        
    }

    public function add($list) {
        echo "id de la liste " + $list;

        $this->set('id', $list);
    }

    public function delete($id) {
        echo $id;
        $item = $this->Item->find('first', array('conditions' => array('Item.id =' => $id)));
        $this->Item->delete($item['Item']['id']);
        return $this->redirect(array('controller' => 'TodoLists', 'action' => 'meslists'));
    }

    public function ajoutItem() {

        if ($this->request->is('post')) {
            echo " liste recu";
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

}
