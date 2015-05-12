<?php 
    use Facebook\FacebookSession; 
    use Facebook\FacebookRedirectLoginHelper;
    use Facebook\FacebookRequest;
    use Facebook\FacebookResponse;
    use Facebook\GraphObject;
    use Facebook\GraphUser;

    echo "<h1 class='text-center login-title'>Créer une liste</h1>";
    echo $this->Form->create('TodoList',array('type' => 'file', 'class' => 'form-signin'));
        echo $this->Form->input('nom',array("label" => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nom', 'required autofocus', 'div' => false));
        echo '<br><div class="inline_labels">';
            echo $this->Form->input('date',array(
                'label' => false, 'type' => 'date',
                'dateFormat' =>'DMY',
                'minYear' => date('Y'),
                'empty' => '',
                'selected' => ''));
        echo "</div><br>";

        $user = $this->Session->read("User");
        if($user["id_facebook"]!=0){
            echo "<p>Liste des amis facebook: </p>";
            $session = FacebookSession::setDefaultApplication('795142420534653', '4d3da35606e8450794bbeb3e7492c4c8');
            $facebookRedirect = Router::url('/users/edit', true);
            $helper = new FacebookRedirectLoginHelper($facebookRedirect);
            $session = FacebookSession::newAppSession();

            try{
                $session->validate();
            }catch (FacebookRequestException $ex){
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
    
    echo $this->Form->button("Valider", array('class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit', 'div' => false));

    echo $this->Form->end();
    
 ?>