<?php 

	echo "<div class='row'>
               <h1 class='text-center login-title'>Inscription</h1>
                    <div class='account-wall'>";

		echo $this->Form->create('User',array('type' => 'file', 'class' => 'form-signin'));

			echo $this->Form->input('nom',array("label" => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nom', 'required autofocus', 'div' => false));

			echo $this->Form->input('prenom',array("label" => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Prénom', 'required autofocus', 'div' => false));

			echo '<br><div class="inline_labels">';
			echo $this->Form->input('date_de_naissance', array(
									'label' => false, 'type' => 'date', 'required autofocus',
									'before' => '',
									'after' => '',
								   	'dateFormat' => 'DMY', 
								   	'minYear' => date('Y') - 100,
								   	'maxYear' => date('Y')));
			echo "<br>";

			$options=array('M'=>'Masculin','F'=>'Féminin');
			$attributes=array('legend'=>false,'value'=>'M',);
			echo '<div class="inline_labels">';
			echo $this->Form->radio('sexe', $options, $attributes);
			echo '</div><br>';

			echo $this->Form->input('mail', array( "label" => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Identifiant (Email)', 'required autofocus', 'div' => false));

			echo $this->Form->input('mot_de_passe' , array("label" => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Mot de passe', 'required', 'div' => false));

			echo $this->Form->input('mot_de_passe_verif' , array("label" => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirmez mot de passe', 'required', 'div' => false));

			echo $this->Form->input('photo_file', array('label'=>'Votre photo (format : jpg ou png)','type'=>'file', 'class' => 'form-control'));

			echo "<br>";

			echo $this->Form->button("S'enregistrer", array('class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit', 'div' => false));

			echo $this->Form->end();

		echo "          </div> 
           </div>";

	?>