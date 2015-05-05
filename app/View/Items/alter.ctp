<?php

echo $this->Form->create('Item', Array('action' => 'modif/'.$id.'/'.$id_todolist));


echo $this->Form->input("nom", Array('value' => $nom));
echo $this->Form->Hidden("id",array('value'=>$id));

echo $this->Form->end('Valider');

?> 