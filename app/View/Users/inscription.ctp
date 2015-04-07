<!-- File: /app/View/Users/inscription.ctp -->

    
<?php
  echo $this->Form->create('User', array('action' => 'inscription'));
 
  
	echo "<table>";
	 
		echo $this->Form->input('nom', array( "label" => "Nom", 'before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false));
		echo $this->Form->input('prenom', array( "label" => "Prenom", 'before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false));  
		echo $this->Form->input('date_de_naissance', array( "label" => "Date de naissance", 'before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false)); 
		echo $this->Form->input('sexe', array( "label" => "Sexe", 'before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false)); 
		echo $this->Form->input('mail', array( "label" => "Mail", 'before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false)); 
		echo $this->Form->input('password' , array('type' => 'password', "label" => "Mot de passe", 'before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false));
		echo $this->Form->input('password_r' , array('type' => 'password', "label" => "confirmer mot de passe", 'before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false));
		echo $this->Form->input('photo', array( "label" => "Photo", 'before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false)); 
		echo $this->Form->submit("Inscription", array('before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false));
		 
	echo"</table>";
  

    
 echo $this->Form->end();
?> 
