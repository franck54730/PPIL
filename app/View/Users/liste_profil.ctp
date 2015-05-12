<?php
    echo "<h1 class='text-center login-title'>Liste des profils :</h1>";
?>
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
                echo $this->Form->create('User', array('action' => 'voir/' . $user['User']['id'],'class' => 'form-signin'));
                echo $this->Form->button("Voir", array('class' => 'btn btn-sm btn-primary btn-block', 'type' => 'submit', 'div' => false));
                echo $this->Form->end();
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
<?php unset($utilisateurs); ?>


</table>