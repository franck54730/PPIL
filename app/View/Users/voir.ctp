	<?php
	    echo "<table>";

	    echo "<tr>";

	    echo "<td>";
		echo "Nom";
		echo"</td>";

	    echo "<td>";
		echo $utilisateur["nom"];
		echo"</td>";

		echo "</tr>";
		 

		echo "<tr>";
	    
	    echo "<td>";
		echo "Prénom";
		echo"</td>";

	    echo "<td>";
		echo $utilisateur["prenom"];
		echo"</td>";

		echo "</tr>";

		echo "<tr>";
	    
	    echo "<td>";
		echo "Date de naissance";
		echo"</td>";

	    echo "<td>";
		echo $utilisateur["date_de_naissance"];
		echo"</td>";

		echo "</tr>";

		echo "<tr>";
	    
	    echo "<td>";
		echo "Sexe";
		echo"</td>";

	    echo "<td>";
		echo $utilisateur["sexe"];
		echo"</td>";

		echo "</tr>";

		echo "<tr>";
	    
	    echo "<td>";
		echo "Mail";
		echo"</td>";

	    echo "<td>";
		echo $utilisateur["mail"];
		echo"</td>";

		echo "</tr>";

		echo "<tr>";
	    
	    echo "<td>";
		echo "Photo";
		echo"</td>";

                echo "<td>";
                if($utilisateur["photo"]!=""){
                    echo $this->Html->image($utilisateur["photo"], array('alt' => 'Photo de profil', 'width'=>200, 'height'=>200));
                }
                else{
                	if($user['User']['sexe'] == 'F'){
                		echo $this->Html->image("avatars/defautF.jpg", array('class' => 'profile-img', 'alt' => 'Photo de profil', 'width' => '100', 'height' => '200'));
                	}
                	else{
                		echo $this->Html->image("avatars/defautM.jpg", array('class' => 'profile-img', 'alt' => 'Photo de profil', 'width' => '100', 'height' => '200'));
                	}
                }
		echo"</td>";

		echo "</tr>";
		echo"</table>";
	?>