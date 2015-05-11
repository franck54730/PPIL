<script type="text/javascript">
function toggle(id)
{
	var divId = document.getElementById(id);
	var toggled = divId.style.display;
	divId.style.display = divId.style.display=='inline'?'none':'inline';
	var button = document.getElementById("b"+id);
	button.value = divId.style.display=='inline'?"Hide":"Show";
}
</script>
<table>
	<?php 
	$i = 0;
	foreach ($lists as $list):
	?>
		<tr>
			<td style="padding-right: 10px"><?php echo $list[$i]['TodoList']['id']; ?>
			</td>
			<td><?php
				echo $this->Form->create('TodoList', array('action' => 'delete/' . $list[$i]['TodoList']['id']));
				echo $this->Form->end('Supprimer');
			?>
	        </td>
			<td><?php
				echo $this->Form->create('TodoList', array('action' => 'alter/'. $list[$i]['TodoList']['id']));
	            echo $this->Form->end('Modifier');
	                ?>
	         </td>
	         <td><?php $id = $list[$i]['TodoList']['id'];
	         
	         			$disabled = '';//a ameliorer pour désactiver le bouton count($arrayitems[$list[$i]['TodoList']['id']])>0?'':'disabled';?>
	         	<?php echo '<input type="button" id="b'.$id.'" onclick="toggle('.$id.')" '.$disabled.' value="Show">' ;?>
	         </td>
	    </tr>
	    <tr>
	    	<td colspan=3>
	    		<div id="<?php echo $id;?>" style="display:none;"> 
	    			<!-- <table style="display:inline;"> -->
		    			<?php 
		    			$items= $arrayitems[$list[$i]['TodoList']['id']];
		    			foreach($items as $item){
		    				if(!$item['checked']){
								echo $this->Form->create('Item', array('action' => 'check/'.$item['id']));
								echo "<div>".$item['nom']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
								$this->Form->checkbox('checked', array('onCLick' => 'submit()'))."</div>";
								echo $this->Form->end();
							}
		    			}
		    			?>
	    			<!--  </table> -->
	    		</div>
	    	</td>
	    </tr>
	    <?php 
    endforeach; ?>
	<?php 
	unset($lists); ?>
</table>
