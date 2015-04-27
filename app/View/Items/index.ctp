
        
            
  <table>
  	
     <?php
    
      if(!isset($items)){
      	
         $items = array();
        
     }
      
     foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['Item']['id']; ?></td>
        <td>
            <?php echo $item['Item']['nom']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($items); ?>
    
    
</table>    

