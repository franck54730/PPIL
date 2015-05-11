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
		document.getElementById('status').innerHTML = 'Please log ' +
		'into Facebook.';
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
		cookie     : true,

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
	
		//Affichage + gestion FB



		use Facebook\FacebookSession; 
		use Facebook\FacebookRedirectLoginHelper;
		use Facebook\FacebookRequest;
		use Facebook\FacebookResponse;
		use Facebook\GraphObject;
		use Facebook\GraphUser;

		$session = FacebookSession::setDefaultApplication('795142420534653', '4d3da35606e8450794bbeb3e7492c4c8');
		$facebookRedirect = Router::url('/users/edit', true);
		$helper = new FacebookRedirectLoginHelper($facebookRedirect);
		$session = FacebookSession::newAppSession();

		try{	
			$session->validate();
		}catch (FacebookRequestException $ex) {
			echo $ex->getMessage();
		}catch (\Exception $ex) {
			echo $ex->getMessage();
		}


		if($user['id_facebook']!= 0){
			$request = new FacebookRequest( $session, 'GET', '/'.$user['id_facebook'].'/friends' );
			$response = $request->execute();
			$users = $response->getGraphObject();
			$data = $users->asArray();
			$data = $data["data"];
			
			echo "<p>Liste des amis facebook: </p>";
			echo "<ul>";
			foreach($data as $test){
				echo "<li>id: " .$test->id."<br/>nom: ".$test->name."</li><br/>";
			}
			echo "</ul>";
		}else{
			echo '<br><fb:login-button scope="public_profile,user_friends" onlogin="checkLoginState();">';
			echo '</fb:login-button><br>';
		}

		echo "<br>";

		echo $this->Form->button("Valider les modifications", array('class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit', 'div' => false));

	echo $this->Form->end();

?>

<div id="status">
</div>