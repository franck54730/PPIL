

<?php

echo "Ajouter un item dans la liste ".$nom;
echo $this->Form->create('Item',array('action'=>'ajoutItem/'));
echo $this->Form->input("nom");
echo $this->Form->Hidden("id_todo_lists",array('value'=>$id));
echo $this->Form->end('Valider');
