<?php


		echo "<h1 class='text-center login-title'>Notifications</h1>";
		foreach($notifs as $notif){
		    echo "<div id='".$notif['Notification']['id']."'>";
			echo $notif['Notification']['texte'];
			echo "<br>";
			echo "<a href='todoLists/meslists'>Voir l'&eacute;v&eacute;nement</a>" ;
		echo "</div>";
		}
		


?>
