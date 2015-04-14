<?php
echo $this->Form->create('TodoList',Array('action'=>'modif'));
echo $this->Form->input("id",Array('value'=>$to['TodoList']['id']));
echo $this->Form->input("nom",Array('value'=>$to['TodoList']['nom']));
echo $this->Form->input("date",Array('value'=>$to['TodoList']['date']));
echo $this->Form->input("frequence",Array('value'=>$to['TodoList']['frequence']));
echo $this->Form->input("unite_frequence",Array('value'=>$to['TodoList']['unite_frequence']));
echo $this->Form->input("date_fin",Array('value'=>$to['TodoList']['date_fin']));
echo $this->Form->end('Valider');

//foreach($to as $t){
////    echo $t;
//    foreach($t as $a){
//        echo $a;
//    }
//}

?> 