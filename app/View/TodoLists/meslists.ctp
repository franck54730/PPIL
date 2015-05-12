
<script type="text/javascript">
	function toggle(id){
		var divId = document.getElementById(id);
		var toggled = divId.style.display;
		divId.style.display = divId.style.display=='inline'?'none':'inline';
		var button = document.getElementById("b"+id);
		button.value = divId.style.display=='inline'?"Hide":"Show";
	}
</script>

<?php 
	echo "<h1 class='text-center login-title'>Mes listes</h1>";
	$i = 0;
	foreach ($lists as $list):
	$id = $list[$i]['TodoList']['id'];
	echo "<div class='container'>
			<div class='row' >
				<div class='col-sm-6 col-sm-offset-1 liste-item' onclick=\"toggle($id)\">
        			<div class='col-sm-5 text-left'>";
						echo $list[$i]['TodoList']['nom'];
						echo $this->Html->link(
									$this->Html->image('crayon.png', array('alt' => 'Modifier', 'title'=>'Modifier la liste', 'class' => 'img-liste')),
									array('action' => 'alter/'. $list[$i]['TodoList']['id']), array('escape' => false));
					echo "</div>";
					echo "<div class='col-sm-5 col-sm-offset-2 text-right'>";
						echo $list[$i]['TodoList']['date'];
					echo "</div>";
				echo "</div>";
			echo "</div>";
	
	/* Ne dois pas être ici !
	echo $this->Form->create('TodoList', array('action' => 'delete/' . $list[$i]['TodoList']['id']));
	echo $this->Form->end('Supprimer');*/
      
	$disabled = '';//a ameliorer pour désactiver le bouton count($arrayitems[$list[$i]['TodoList']['id']])>0?'':'disabled';
	//echo '<input type="button" id="b'.$id.'" onclick="toggle('.$id.')" '.$disabled.' value="Show">' ;
?>

<div id="<?php echo $id;?>" style="display:none;"> 
	<!-- <table style="display:inline;"> -->
	<?php 
		$items= $arrayitems[$list[$i]['TodoList']['id']];
		foreach($items as $item){
			//if(!$item['checked']){
				echo $this->Form->create('Item', array('action' => 'check/'.$item['id']));
				echo "<div class='row'>";
					echo "<div class='col-sm-6 col-sm-offset-1 liste-item'>";
						echo "<div class='col-sm-1 text-left'>";
							echo $this->Form->checkbox('checked', array('onCLick' => 'submit()', 'class' => 'checkbox'));
						echo "</div>";
						echo "<div class='col-sm-10 col-sm-offset-1 text-left'>";
							echo $item['nom'];
						echo "</div>";
					echo "</div>";
				echo "</div>";
				echo $this->Form->end();
			//}
		}
	echo "</div>";
	?>
	<!--  </table> -->
</div>

<?php 
    endforeach; 
	unset($lists);
?>