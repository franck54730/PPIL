<?php 
    
    use Facebook\FacebookSession; 
    use Facebook\FacebookRedirectLoginHelper;
    use Facebook\FacebookRequest;
    use Facebook\FacebookResponse;
    use Facebook\GraphObject;
    use Facebook\GraphUser;
    
    echo"<script type=\"text/javascript\">
    var i = 0;
	function ajouter(){
		var divId = document.getElementById('ajout');
		var input = document.createElement(\"input\");
		var submit = document.getElementById('lol');
		
		input.type = \"text\";
		input.id = 'item'+i;
        input.innerHTML = 'je suis un item';
		input.name='data[TodoList][item]['+i+']';
		input.required=true;
		submit.parentNode.insertBefore(input,submit);
		i++;
	}
	
	function suppr(i, bouton){
		
		var input = document.getElementById('item'+i);
		var brp = document.getElementById('br'+(i-1));
		input.parentNode.removeChild(bouton);
		alert('coco');
	}
	
	function supprimer(){
		if(i>0){
		 var ctr = \"item\"+(i-1);
		
		 var cTarget = document.getElementById(ctr);
		  cTarget.parentNode.removeChild(cTarget);
		  i--;
		 }
	}
</script>";

    if($this->Session->read("User") != null){
        echo "<h1 class='text-center login-title'>Cr&eacute;er une liste</h1>";
        echo $this->Form->create('TodoList',array('type' => 'file', 'class' => 'form-signin', 'id' => 'ajout'));
            echo $this->Form->input('nom',array("label" => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nom', 'required autofocus', 'div' => false));
            echo '<br><div class="inline_labels">';
                echo $this->Form->input('date',array(
                    'label' => false, 'type' => 'date',
                    'dateFormat' =>'DMY',
                    'minYear' => date('Y'),
                    'empty' => '',
                    'selected' => ''));
            echo "</div><br>";

            $user = $this->Session->read("User");

                
           	foreach($amis as $test){
            	$options[$test['id_facebook']]=$test['name'];
	        }
            if(empty($options)){
                $options = null;
            }
            echo "<div class='container'>
            	<div class='row'>
            		<div class='col-sm-2 col-sm-offset-1 text-left'>";
            			echo $this->Form->input('amis',array('label' => false, 'multiple' => 'checkbox', 'options' => $options));
            		echo "</div>";
            	echo "</div>";
            echo "</div>";
            
            
            
            echo "<div class='container'>
                    <div class='row'>
                        <div class='col-sm-3'>";
                        echo "<h1 class='text-center login-title'>Ajouter des items</h1>";
            echo "</div></div></div>";

          	echo "<div class='container'>
				    <div class='row'>
					    <div class='col-sm-6'>
        				    <div class='col-sm-3'>";
        					   echo "<button class = \"btn btn-lg btn-primary btn-block ajouter-item\" type=\"button\" id = 'add' onclick = \"ajouter()\"> + </button>";
                            echo "</div>";
                            echo "<div class='col-sm-3'>";
                                echo "<button class = \"btn btn-lg btn-primary btn-block supp-item\" type=\"button\" id = 'suppr' onclick = \"supprimer()\"> - </button>";
                            echo "</div>";
				        echo "</div>";
                    echo "</div>";
            echo "</div>";
            
        //Bouton valider
        echo $this->Form->button("Valider", array('class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit', 'div' => false, 'id' => 'lol'));

		//Fin formulaire
		echo $this->Form->end();
		

    }else{
        echo "Petit filou connecte-toi <a href =\"http://localhost/ppil/Users/connect\">ici</a> pour acc&eacute;der &agrave; cette page.";
    }

        
 ?>