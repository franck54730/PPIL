<?php
echo "<div id='status_new' class='container'>
            	<div class='row'>
            		<div class='col-sm-2 col-sm-offset-1 text-left'>";

echo  			"<div class=\"input select\">
       						<input  type=\"hidden\"
       								name=\"data[TodoList][amis]\"
       								value=\"\"
       								id=\"TodoListAmis\">";

foreach ($amisFacebook as $test){
	echo 	"<div class=\"checkbox\">
			       							<input  type=\"checkbox\"
			       									name=\"data[TodoList][amis][]\"
			       									value=\"".$test['id_facebook']."\"
			       									id=\"TodoListAmis".$test['id_facebook']."\">
			       							<label for=\"TodoListAmis".$test['id_facebook']."\">
			       								".$test['name']."
			       							</label>
			       						</div>";
}
 
//        						<div class=\"checkbox\">
//        							<input  type=\"checkbox\"
//        									name=\"data[TodoList][amis][]\"
//        									value=\"10206598752838181\"
//        									id=\"TodoListAmis10206598752838181\">
//        							<label for=\"TodoListAmis10206598752838181\">
//        								Adrien Jeannerot
//        							</label>";
	
echo		"</div>
    					</div>";

echo    "</div>";
//        	echo FormHelper::input('amis',array('label' => false, 'multiple' => 'checkbox', 'options' => $options));
echo    "</div>";
echo "</div>";