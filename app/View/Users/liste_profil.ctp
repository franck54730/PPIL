<table>
    <?php
    foreach ($utilisateurs as $user):
        ?>
    <tr>
        <td>
        <?php
        
        echo $user['User']['nom']; ?> 
        </td>
            <td>
                <?php
                echo $this->Form->create('User', array('action' => 'voir/' . $user['User']['id']));
                echo $this->Form->end('Voir');
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
<?php unset($utilisateurs); ?>


</table>