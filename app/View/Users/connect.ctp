	<!-- File: /app/View/Users/connexion.ctp -->
   
  <?php

    echo "<div class='row'>
               <h1 class='text-center login-title'>Connexion</h1>
                    <div class='account-wall'>";

      echo $this->Form->create('User', array('class' => 'form-signin', 'action' => 'connect'));
	 
		    echo $this->Form->input('mail', array( "label" => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Identifiant (Email)', 'required autofocus', 'div' => false));
		 
		    echo $this->Form->input('motDePasse' , array("label" => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Mot de passe', 'required', 'div' => false));
		
		    echo $this->Form->button("Connexion", array('class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit', 'div' => false));

        echo "<br></br>";

        echo $this->Html->link("Inscription", array('controller' => 'users', 'action' => 'signup'));

   	  echo $this->Form->end();

   	echo "          </div> 
           </div>";
	?>