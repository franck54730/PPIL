<h1>BONJOUR</h1>

<table>
     <?php if(!isset($lists)){
         $lists = array();
     }
     foreach ($lists as $list): ?>
    <tr>
        <td><?php echo $list['TodoList']['id']; ?></td>
        <td>
            <?php echo $list['TodoList']['name']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($lists); ?>
    
    
</table>