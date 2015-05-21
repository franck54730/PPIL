<script>

function createRequestObject() {
    var tmpXmlHttpObject;
    if (window.XMLHttpRequest) { 
        tmpXmlHttpObject = new XMLHttpRequest();
    } else if (window.ActiveXObject) { 
        tmpXmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    return tmpXmlHttpObject;
}

var http = createRequestObject();

function updateFacebookId(id) {
    http.open('get', 'association_facebook?id=' + id);
    http.onreadystatechange = processResponse;
    http.send(null);
}

function dissociationFacebookId(){
    http.open('get', 'dissociation_facebook');
    http.onreadystatechange = processResponse;
    http.send(null);
}

function processResponse() {
    if(http.readyState == 4){
        document.getElementById('status').innerHTML = 'Profil mis a jour !';
	location.reload();
    }
}

function statusChangeCallback(response) {
	console.log('statusChangeCallback');
	console.log(response);
	if (response.status === 'connected') {
		var test = <?php echo $user['id_facebook']; ?>;
		if(test == 0){
			updateFacebookId(response['authResponse']['userID']);
		}
	} else if (response.status === 'not_authorized') {
		document.getElementById('status').innerHTML = 'Please log ' +
		'into this app.';
	} else {
		
	}
}

function checkLoginState() {
	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});
}

window.fbAsyncInit = function() {
	FB.init({
		appId      : '795142420534653',
		cookie     : false,

		xfbml      : true,
		version    : 'v2.2'
	});

	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});
};

(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>
 <?php
 	if($this->Session->read("User")!=null){
		echo $this->Form->create('User',array('class' => 'form-signin', 'type' => 'file')); 
			echo $this->Form->input('nom',array('label'=>"Nom : ", 'class' => 'form-control', 'placeholder' => 'Nom', 'default'=>$user["nom"]));
			echo $this->Form->input('prenom',array('label'=>"Prénom : ", 'class' => 'form-control', 'placeholder' => 'Prénom', 'default'=>$user["prenom"]));
			echo $this->Form->input('date_de_naissance', array( 'selected' => $user['date_de_naissance'],'label' => false, 
									   'dateFormat' => 'DMY', 
									   'minYear' => date('Y') - 100,
									   'maxYear' => date('Y')));

		
			echo "<br>";

			$options=array('M'=>'Masculin','F'=>'Féminin');
			$attributes=array('legend'=>false,'value'=>$user["sexe"]);
			echo "<div class='inline_labels'>";
			echo $this->Form->radio('sexe',$options,$attributes);
			echo "</div>";

			if($user['id_facebook']== 0){
				echo '<br><fb:login-button scope="public_profile,user_friends" onlogin="checkLoginState();">';
				echo '</fb:login-button><br>';
			}else{
			  echo"
			  <button type=\"button\" onclick=\"dissociationFacebookId();\">
			    Dissocier son compte Facebook
			   </button>";	
			}

			echo "<br>";

			echo $this->Form->button("Valider les modifications", array('class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit', 'div' => false));

		echo $this->Form->end();
		echo $this->Html->link("Supprimer mon compte", array('controller' => 'users', 'action' => 'delete'));
	}else{
		echo "Petit hacker connecte-toi <a href =\"http://localhost/ppil/Users/connect\">ici</a> pour acc&eacute;der &agrave; cette page.";
	}
?>

<div id="status">
</div>