<div class='container'>
	<div class='row' >
		<div class='col-sm-7'>
			<div class='col-sm-8 text-right'>
				<h1 class='text-center title-editer'>Editer une liste</h1>
			</div>
			<div class='col-sm-1 col-sm-offset-3 text-right'>
				<?php
					echo $this->Form->create('Todolist', array('action' => 'delete/' . $to['TodoList']['id']));
						echo $this->Form->submit('poubelle.png', array('alt' => 'Supprimer', 'title'=>'Supprimer la liste', 'class' => 'poubelle'));
					echo $this->Form->end();
				?>
			</div>
		</div>
	</div>
</div>
<?php
	echo $this->Form->create('TodoList', Array('class' => 'form-signin', 'action' => 'modif'));
		echo $this->Form->Hidden("id", Array('value' => $to['TodoList']['id']));
		echo $this->Form->Hidden("frequence", Array('value' => $to['TodoList']['frequence']));
		echo $this->Form->Hidden("unite_frequence", Array('value' => $to['TodoList']['unite_frequence']));
		echo $this->Form->Hidden("date_fin", Array('value' => $to['TodoList']['date_fin']));
		echo $this->Form->input('nom', array('value' => $to['TodoList']['nom'], "label" => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nom', 'required autofocus', 'div' => false));
		echo '<br><div class="inline_labels">';
		echo $this->Form->input("date", Array('label' => false, 'type' => 'date', 'required autofocus', 'value' => $to['TodoList']['date']));
		echo "</div><br>";
		echo $this->Form->button("Valider", array('class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit', 'div' => false));
	echo $this->Form->end();
	foreach($it as $item){
		echo "<div class='container'>
				<div class='row'>
					<div class='col-sm-6 col-sm-offset-1 liste-item'>
        				<div class='col-sm-5 text-left'>";
							echo  $item['Item']['nom'];
						echo "</div>";
						echo "<div class='col-sm-1 col-sm-offset-5 text-right'>";
							echo $this->Form->create('Item', array('action' => 'modif/' . $item['Item']['id']."/".$item['Item']['id_todo_lists']));
								echo $this->Form->submit('crayon.png', array('alt' => 'Modifier', 'title'=>'Modifier l\'item', 'class' => 'img-liste'));;
							echo $this->Form->end();
						echo "</div>";
						echo "<div class='col-sm-1 text-right'>";
							echo $this->Form->create('Item', array('action' => 'delete/' . $item['Item']['id']));
								echo $this->Form->submit('supprimer-item.png', array('alt' => 'Supprimer', 'title'=>'Supprimer l\'item', 'class' => 'img-liste'));;
							echo $this->Form->end();
						echo "</div>";
					echo "</div>";
				echo "</div>";
		echo "</div>";
	}
	echo $this->Form->create('Item',array('class' => 'form-signin', 'action'=>'ajoutItem/'));
		echo "<div class='container'>
				<div class='row'>
					<div class='col-sm-4' text-left>
        				<div class='col-sm-6 text-left'>";
							echo $this->Form->input('nom', array('label' => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nom de l\'item', 'required autofocus', 'div' => false));
						echo "</div>";
						echo "<div class='col-sm-6 text-left'>";
							echo $this->Form->button("+", array('class' => 'btn btn-lg btn-primary btn-block bouton-plus', 'type' => 'submit', 'div' => false));
						echo "</div>";
					echo "</div>";
				echo "</div>";
		echo "</div>";
		echo $this->Form->Hidden("id_todo_lists",array('value'=>$to['TodoList']['id']));
	echo $this->Form->end()
?>