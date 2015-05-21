<div id ='profils'>
<?php
$i = 0;
        foreach ($users as $user):
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
        endforeach;
?>
</div>