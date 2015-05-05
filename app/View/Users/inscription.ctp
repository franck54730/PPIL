<!-- File: /app/View/Users/inscription.ctp -->

    
<?php
	
	echo "Salut";
	echo "<div class='container'>
            <div class='row'>
                <div class='col-sm-6 col-md-4 col-md-offset-4'>
                    <h1 class='text-center login-title'>Inscription</h1>
                    <div class='account-wall'>
                        <img class='profile-img' src='img/dobble_logo.jpg' alt=''>";

		echo $this->Form->create('User', array('class' => 'form-signin', 'action' => 'inscription'));
	 
			echo $this->Form->input('nom', array( "label" => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nom', 'required autofocus', 'div' => false));

			echo $this->Form->input('prenom', array( "label" => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Prénom', 'required autofocus', 'div' => false));  
		
			echo $this->Form->input('date_de_naissance', array( "label" => "Date de naissance", 'before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false)); 
		
			echo $this->Form->input('sexe', array( "label" => "Sexe", 'before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false)); 
			
			echo $this->Form->input('mail', array( "label" => false, 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'Identifiant (Email)', 'required autofocus', 'div' => false)); 
		
			echo $this->Form->input('password' , array("label" => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Mot de passe', 'required', 'div' => false));
			
			echo $this->Form->input('password_r' , array("label" => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirmez mot de passe', 'required', 'div' => false));
			
			echo $this->Form->input('photo', array( "label" => "Photo", 'before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false)); 
		
			echo $this->Form->>button("Inscription", array('class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit', 'div' => false));
		 
		echo $this->Form->end();

	echo "          </div>
	            </div>
            </div>
        </div>";
?> 
