<?php
	if($this->Session->read("User")==null){
		echo "Tu n'as pas le droit de faire ça.";
	}else{

		echo "<h1 class='text-center login-title'>Notifications</h1>";
		$notifs = array_reverse($notifs);
		foreach($notifs as $notif){
		    echo "<div id='".$notif['Notification']['id']."'>";
			echo $notif['Notification']['texte'];
			echo "<br>";
			echo "<a href='todoLists/meslists'>Voir l'&eacute;v&eacute;nement</a>" ;
		echo "</div>";
		}
	}


?>
