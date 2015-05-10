<?php 
    use Facebook\FacebookSession; 
    use Facebook\FacebookRedirectLoginHelper;
    use Facebook\FacebookRequest;
    use Facebook\FacebookResponse;
    use Facebook\GraphObject;
    use Facebook\GraphUser;
    echo $this->Form->create();
    echo $this->Form->input('nom');
    echo $this->Form->input('date',array(
        'dateFormat' =>'DMY',
        'minYear' => date('Y'),
        'empty' => '',
        'selected' => ''
    ));
    $user = $this->Session->read("User");
    if($user["id_facebook"]!=0){
        echo "<p>Liste des amis facebook: </p>";
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
        $request = new FacebookRequest( $session, 'GET', '/'.$user['id_facebook'].'/friends' );
	$response = $request->execute();
	$users = $response->getGraphObject();
	$data = $users->asArray();
	$data = $data["data"];
        $i=0;
	foreach($data as $test){
		$options[$test->id]=$test->name;
                $i++;
	}
	  
        echo $this->Form->input('amis',array('multiple' => 'checkbox', 'options' => $options));
    }
    
    
    echo $this->Form->end('Valider');
    
 ?>