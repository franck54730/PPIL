<table>
    <?php $i = 0;
    foreach ($lists as $list):
        ?>
        <tr>
            <td><?php echo $list[$i]['TodoList']['id']; ?></td>
            <td>
    <?php echo $list[$i]['TodoList']['nom']; ?>
            </td>
            <td><td>
                <?php
                echo $this->Form->create('Todolist', array('action' => 'delete/' . $list[$i]['TodoList']['id']));
                echo $this->Form->end('Supprimer');
                ?>
            </td><td>
                <?php
                echo $this->Form->create('Todolist', array('action' => 'alter/'. $list[$i]['TodoList']['id']));
                echo $this->Form->end('Modifier');
                ?></td>
            </td>
        </tr>
    <?php endforeach; ?>
<?php unset($lists); ?>


</table>