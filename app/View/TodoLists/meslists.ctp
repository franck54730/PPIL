<h1>BONJOUR</h1>

<table>
     <?php $i=0; foreach ($lists as $list): ?>
    <tr>
        <td><?php echo $list[$i]['TodoList']['id']; ?></td>
        <td>
            <?php echo $list[$i]['TodoList']['name']; $i++; ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($lists); ?>
    
    
</table>