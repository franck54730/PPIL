<table>
    <?php
    foreach ($lists as $list):
        ?>
      <tr><td>
      <?php echo  $list['Item']['nom']; ?>
            </td>
             <td><td>
                <?php
                echo $this->Form->create('Item', array('action' => 'delete/' . $list['Item']['id']));
                echo $this->Form->end('Supprimer');
                ?>
            </td><td>
                <?php
                echo $this->Form->create('Item', array('action' => 'alter/'. $list['Item']['id'].'/'.$list['Item']['id_todo_lists']));
                echo $this->Form->end('Modifier');
                ?></td>
            </td>
       	
        </tr>
    <?php endforeach; ?>
<?php unset($lists); ?>


</table>