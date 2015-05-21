
<?php if($this->request->is("get")){
    echo "Tu n'as pas l'authorisation de faire ceci, petit coquin";
}else{

    ?>
    <table>
     <?php if(!isset($lists)){
         $lists = array();
     }
     foreach ($lists as $list): ?>
    <tr>
        <td><?php echo $list['TodoList']['id']; ?></td>
        <td>
            <?php echo $list['TodoList']['nom']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($lists); ?>
    
    
</table>
<?php }?>
