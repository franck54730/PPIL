<<<<<<< HEAD
<!-- File: /app/View/Users/connexion.ctp -->
=======
	<!-- File: /app/View/Users/connexion.ctp -->
>>>>>>> 3e9bfef52c1b409f37811418de88aafac8478a3c


 
   
  <?php
	  echo $this->Form->create('User', array('action' => 'connect'));   
	    echo "<table>";
	 
		echo $this->Form->input('mail', array( "label" => "Email", 'before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false));
		 
		echo $this->Form->input('motDePasse' , array('type' => 'password', "label" => "Mot de passe", 'before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false));
		
		echo $this->Form->submit("Connexion", array('before' => '<tr><td>', 'after' => '</td></tr>', 'between' =>'</td><td>', 'div' => false));
		 
		echo"</table>";
   	  echo $this->Form->end();
	?> 
    
     
    <br>
    
    
    <?php
<<<<<<< HEAD
    	echo $this->Html->link("Nouveau Joueur", array('controller' => 'users', 'action' => 'inscription'));
=======
    	echo $this->Html->link("Inscription", array('controller' => 'users', 'action' => 'inscription'));
>>>>>>> 3e9bfef52c1b409f37811418de88aafac8478a3c
    ?>