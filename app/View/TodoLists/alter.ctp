<?php

echo $this->Form->create('TodoList', Array('action' => 'modif'));
echo $this->Form->input("id", Array('value' => $to['TodoList']['id']));
echo $this->Form->input("nom", Array('value' => $to['TodoList']['nom']));
echo $this->Form->input("date", Array('value' => $to['TodoList']['date']));
echo $this->Form->input("frequence", Array('value' => $to['TodoList']['frequence']));
echo $this->Form->input("unite_frequence", Array('value' => $to['TodoList']['unite_frequence']));
echo $this->Form->input("date_fin", Array('value' => $to['TodoList']['date_fin']));
echo $this->Form->end('Valider');
<<<<<<< HEAD
echo $this->Form->create('Item', array('action' => 'add/'. $to['TodoList']['nom'] .'/'.$to['TodoList']['id']));
                echo $this->Form->end('ajouter un item');
=======

echo $this->Form->create('Item', array('action' => 'add/' . $to['TodoList']['id']));
echo $this->Form->end('ajouter un item');


foreach ($it as $t) {
    foreach ($t as $item) {
>>>>>>> 70d06f39f7f20b5bb87efe441c15ddb528437bdb

        echo "<table>";
        echo "<td>";
        echo $item['nom'];
        echo "</td>";
        echo "<td>";
        echo $this->Form->create('Item', array('action' => 'delete/' . $item['id']));
        echo $this->Form->end('supprimer');
        echo "</td>";

        echo "</table>";

        echo"<br>";
    }
}
?> 