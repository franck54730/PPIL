	<?php
	    echo "<table>";

	    echo "<tr>";

	    echo "<td>";
		echo "Nom";
		echo"</td>";

	    echo "<td>";
		echo $user["nom"];
		echo"</td>";

		echo "</tr>";
		 

		echo "<tr>";
	    
	    echo "<td>";
		echo "Prénom";
		echo"</td>";

	    echo "<td>";
		echo $user["prenom"];
		echo"</td>";

		echo "</tr>";

		echo "<tr>";
	    
	    echo "<td>";
		echo "Date de naissance";
		echo"</td>";

	    echo "<td>";
		echo $user["date_de_naissance"];
		echo"</td>";

		echo "</tr>";

		echo "<tr>";
	    
	    echo "<td>";
		echo "Sexe";
		echo"</td>";

	    echo "<td>";
		echo $user["sexe"];
		echo"</td>";

		echo "</tr>";

		echo "<tr>";
	    
	    echo "<td>";
		echo "Mail";
		echo"</td>";

	    echo "<td>";
		echo $user["mail"];
		echo"</td>";

		echo "</tr>";

		echo "<tr>";
	    
	    echo "<td>";
		echo "Photo";
		echo"</td>";

	    echo "<td>";
	    echo $this->Html->image($user["photo"], array('alt' => 'Photo de profil', 'width'=>200, 'height'=>200));
		echo"</td>";

		echo "</tr>";
		echo"</table>";
	?> 
	
	<a href="edit">Modifier mon profil</a>
	