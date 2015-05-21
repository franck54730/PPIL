<script type="text/javascript">

    function toggle(id){
        var divId = document.getElementById(id);
        var toggled = divId.style.display;
        divId.style.display = divId.style.display=='inline'?'none':'inline';
        var button = document.getElementById("b"+id);
        button.value = divId.style.display=='inline'?"Hide":"Show";
    }

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

    function chercherProfils() {
        var texte = document.getElementById("texte").value;
        http.open('get', 'chercher_profils/'+texte);
        http.onreadystatechange = processResponse;
        http.send(null);
        return false;
    }

    function processResponse() {
        if(http.readyState == 4){
            document.getElementById('status').innerHTML = http.responseText;
            document.getElementById('status').innerHTML = document.getElementById("profils").innerHTML;
        }
    }

</script>

<?php
if($this->Session->read("User")!=null){
    echo "<h1 class='text-center login-title'>Rechercher un profil :</h1>";
        echo "<form id='form' onSubmit='return chercherProfils();'><input type ='text' id ='texte'></form>";
      
        echo "<h1 class='text-center login-title'>Liste des profils :</h1>";
        
        echo "<div id='status'>";
        $i = 0;
        foreach ($utilisateurs as $user):
            $id = $user['User']['id'];
            echo "<div class='container'>
                    <div class='row' >
                        <div class='col-sm-6 col-sm-offset-1 liste-item' onclick=\"toggle($id)\">
                            <div class='col-sm-5 text-left'>";
                                echo $user['User']['nom']." ".$user['User']['prenom'];
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
    ?>

    <div id="<?php echo $id;?>" style="display:none;"> 
        <!-- <table style="display:inline;"> -->
        <?php 
           
                echo "<div class='row'>";
                    echo "<div class='col-sm-6 col-sm-offset-1 liste-item'>";
                        echo "<div class='col-sm-2 text-left'>";
                             if($user['User']["photo"]!=""){
                                echo $this->Html->image($user['User']['photo'], array('class' => 'profile-img', 'alt' => 'Photo de profil', 'width' => '100', 'height' => '200'));
                             }
                        echo "</div>";
                        echo "<div class='col-sm-3 col-sm-offset-5 text-right liste-profil'>";
                         echo "<div class='row'>";
                                echo $user['User']['mail'];
                            echo "</div>";
                            echo "<div class='row'>";
                                echo $user['User']['date_de_naissance'];
                            echo "</div>";
                            echo "<div class='row'>";
                            if($user['User']['sexe'] == 'F'){
                                echo "Femme";
                            }
                            else{
                                echo "Homme";
                            }
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                //}
            
            echo "</div>";
        ?>
        <!--  </table> -->
    </div>

    <?php
        endforeach;?></div><?php
        unset($utilisateurs);
    }else{
        echo "Petit hacker connecte-toi <a href =\"http://localhost/ppil/Users/connect\">ici</a> pour acc&eacute;der &agrave; cette page.";
    }
?>