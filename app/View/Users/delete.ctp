<?php
	echo "<div class='row'>
               <h1 class='text-center login-title'>D&eacute;sinscription</h1>
                    <div class='account-wall'>";

	echo $this->Form->create('User',array('class' => 'form-signin', 'type' => 'file')); 
	echo $this->Form->input('mot_de_passe' , array("label" => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Mot de passe', 'required', 'div' => false));
	echo $this->Form->button("Se d&eacute;sinscrire", array('class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit', 'div' => false));

	echo $this->Form->end();



?>