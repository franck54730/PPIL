	<?php

		echo "<h1 class='text-center login-title'>Gérer mon compte</h1>";
		echo "<div class='row'>";
			echo "<div class='col-sm-3'>";
				echo "Nom : ";
			echo "</div>";
			echo "<div class='col-sm-offset-0 col-sm-2'>";
				echo $user["nom"];
			echo "</div>";
		echo "</div>";

		echo "<div class='row'>";
			echo "<div class='col-sm-3'>";
				echo "Prénom : ";
			echo "</div>";
			echo "<div class='col-sm-offset-0 col-sm-2'>";
				echo $user["prenom"];
			echo "</div>";
		echo "</div>";

		echo "<div class='row'>";
			echo "<div class='col-sm-3'>";
				echo "Date de naissance : ";
			echo "</div>";
			echo "<div class='col-sm-offset-0 col-sm-2'>";
				echo $user["date_de_naissance"];
			echo "</div>";
		echo "</div>";

		echo "<div class='row'>";
			echo "<div class='col-sm-3'>";
				echo "Sexe : ";
			echo "</div>";
			echo "<div class='col-sm-offset-0 col-sm-2'>";
				echo $user["sexe"];
			echo "</div>";
		echo "</div>";

		echo "<div class='row'>";
			echo "<div class='col-sm-3'>";
				echo "Mail : ";
			echo "</div>";
			echo "<div class='col-sm-offset-0 col-sm-2'>";
				echo $user["mail"];
			echo "</div>";
		echo "</div>";

		echo "<div class='row'>";
			echo "<div class='col-sm-3'>";
				echo "Photo : ";
			echo "</div>";
			echo "<div class='col-sm-offset-0 col-sm-2'>";
				if($user["photo"]!=""){
                	echo $this->Html->image($user["photo"], array('alt' => 'Photo de profil', 'width'=>200, 'height'=>200));
            	}
            echo "</div>";
        echo "</div>";

         echo $this->Html->link("Modifier mon profil", array('controller' => 'users', 'action' => 'edit'));
	?>