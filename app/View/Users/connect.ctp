	<!-- File: /app/View/Users/connexion.ctp -->
   
  <?php

    echo "<div class='container'>
            <div class='row'>
                <div class='col-sm-6 col-md-4 col-md-offset-4'>
                    <h1 class='text-center login-title'>Connexion</h1>
                    <div class='account-wall'>";

      echo $this->Form->create('User', array('class' => 'form-signin', 'action' => 'connect'));
	 
		    echo $this->Form->input('mail', array( "label" => false, 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'Identifiant (Email)', 'required autofocus', 'div' => false));
		 
		    echo $this->Form->input('motDePasse' , array("label" => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Mot de passe', 'required', 'div' => false));
		
		    echo $this->Form->button("Connexion", array('class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit', 'div' => false));

   	  echo $this->Form->end();

   	echo "          </div>
                </div>
            </div>
        </div>";
	?>
    
  <br>
    
  <?php
    echo $this->Html->link("Inscription", array('controller' => 'users', 'action' => 'signup'));
  ?>