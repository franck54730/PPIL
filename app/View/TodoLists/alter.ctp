


<h1 class='text-center login-title'>Editer une liste</h1>
<div>
	<?php
	echo $this->Form->create('Todolist', array('action' => 'delete/' . $to['TodoList']['id']));
	echo $this->Form->end('Supprimer');
	?>
</div>
<div>
	<?php
	echo $this->Form->create('TodoList', Array('action' => 'modif'));
	echo $this->Form->input("id", Array('value' => $to['TodoList']['id']));
	echo $this->Form->input("nom", Array('value' => $to['TodoList']['nom']));
	echo $this->Form->input("date", Array('value' => $to['TodoList']['date']));
	echo $this->Form->end('Valider');
	?>
</div>
<div>
	<table style="width:100%; text-align:left;">
		<?php
		
		foreach($it as $item){
			echo "<tr style=\"border:1px solid black;  \"><td style=\"padding-left:10px;\">";
				echo $item['Item']['nom'];
			echo "</td>";
			echo "<td>";
				echo $this->Form->create('Item', array('action' => 'modif/' . $item['Item']['id']."/".$item['Item']['id_todo_lists']));
				echo $this->Form->end('Modifier');
			echo "</td>";
			echo "<td>";
				echo $this->Form->create('Item', array('action' => 'delete/' . $item['Item']['id']));
				echo $this->Form->end('Supprimer');
			echo "</td></tr>";
		}
		?>
		</tr>
	</table>
</div>
<div>
	<?php  echo $this->Form->create('Item',array('action'=>'ajoutItem/'));?>
	<table style="width:40%; text-align:left;">
		<tr>
		<?php 
			echo "<td>";
			echo $this->Form->input("nom");
			echo "</td>";
			echo "<td>";
			echo $this->Form->submit('+', array('class' => 'button blue tiny'));
			echo $this->Form->Hidden("id_todo_lists",array('value'=>$to['TodoList']['id']));
			echo "</td>";
		?>
		</tr>
	</table>
	<?php echo $this->Form->end();?>
</div>