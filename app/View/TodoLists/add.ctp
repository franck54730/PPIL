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
        echo "<h1 class='text-center login-title'>Créer une liste</h1>";
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
            if($user["id_facebook"]!=0){
                echo "<p>Liste des amis facebook: </p>";
                $session = FacebookSession::setDefaultApplication('795142420534653', '4d3da35606e8450794bbeb3e7492c4c8');
                $facebookRedirect = Router::url('/users/edit', true);
                $helper = new FacebookRedirectLoginHelper($facebookRedirect);
                $session = FacebookSession::newAppSession();

                try{
                    $session->validate();
                }catch (FacebookRequestException $ex){
                    echo $ex->getMessage();
                }catch (\Exception $ex) {
                    echo $ex->getMessage();
                }
                $request = new FacebookRequest( $session, 'GET', '/'.$user['id_facebook'].'/friends' );
                $response = $request->execute();   
                $users = $response->getGraphObject();
                $data = $users->asArray();
                $data = $data["data"];
                $i=0;
                foreach($data as $test){
                    $options[$test->id]=$test->name;
                    $i++;
                    
                }
                echo $this->Form->input('amis',array('multiple' => 'checkbox', 'options' => $options));
            }
            
          //Ajout des items 
          	echo "<div class='container'>
				<div class='row'>
					<div class='col-sm-6' text-left>
        				<div class='col-sm-6 text-left'>";
        					echo "<button type=\"button\" id = 'add' onclick = \"ajouter()\"> Ajouter un item </button>";
							echo "<button type=\"button\" id = 'suppr' onclick = \"supprimer()\"> Supprimer un item </button>";
						echo "</div>";
						echo "<div class='col-sm-6 text-left'>";
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