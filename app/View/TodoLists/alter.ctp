<?php
	if($this->Session->read("User") != null && $this->request->is("post")){	
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Supprimer</h4>
      </div>
      <div class="modal-body">
        Voulez vous vraiment supprimer la liste <?php echo $to['TodoList']['nom']?> ?
      </div>
      <div class="modal-footer">
      	<div class="row">
      		<div class="col-sm-1 col-sm-offset-3">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
        	</div>
        	<div class="col-sm-1 col-sm-offset-3">
        		<?php
        			echo $this->Form->create('TodoList', array('action' => 'delete/' . $to['TodoList']['id']));
        				echo $this->Form->submit('Oui', array('alt' => 'Modifier', 'title'=>'Modifier l\'item', 'class' => 'btn btn-primary'));;
        			echo $this->Form->end();
        		?>
        	</div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class='container'>
	<div class='row' >
		<div class='col-sm-7'>
			<div class='col-sm-8 text-right'>
				<h1 class='text-center title-editer'>Editer une liste</h1>
			</div>
			<div class='col-sm-1 col-sm-offset-3 text-right'>
				<?php
					echo $this->Html->image('poubelle.png', array('alt' => "Supprimer la liste", 'title'=>'Supprimer la liste', 'class' => 'poubelle', 'data-toggle'=>'modal', 'data-target'=>'#myModal'));
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
	echo $this->Form->end();
	
	echo "<div class='container'>
                        <div class='row'>";

	foreach($amis as $ami){
		echo $this->Form->create('Todolist', array('controller' => "TodoLists",'action' => 'check/'.$to['TodoList']['id'].'/'.$ami['id'].'/'.($ami['associer']?0:1)));
				echo "<div class='col-sm-2 col-sm-offset-2 text-left'>";
					echo $this->Form->checkbox('checked', array('checked' => $ami['associer'], 'onCLick' => 'submit()', 'class' => 'checkbox'));
				echo "</div>";
				echo "<div class='col-sm-2 text-left'>";
					echo $ami['name'];
				echo "</div>";
		echo $this->Form->end();
	}

	echo "</div>";
        echo "</div>";
            echo "</div>";
	

}else{
	if($this->Session->read("User") == null){
		echo "Petit hacker connecte-toi <a href =\"http://localhost/ppil/Users/connect\">ici</a> pour acc&eacute;der &agrave; cette page.";
	}
}
	
?>