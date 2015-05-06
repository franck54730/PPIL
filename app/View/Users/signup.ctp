<h2>Inscription</h2>

<?php echo $this->Form->create('User',array('type' => 'file')); ?>
	<?php echo $this->Form->input('nom',array('label'=>"Votre nom"));?>
	<?php echo $this->Form->input('prenom',array('label'=>"Votre prénom"));?>
	<?php echo $this->Form->input('date_de_naissance', array( 'label' => 'Date de naissance', 
								   'dateFormat' => 'DMY', 
								   'minYear' => date('Y') - 100,
								   'maxYear' => date('Y')));?>

	<?php echo "<b>Sexe :</b>";
	$options=array('M'=>'Masculin','F'=>'Féminin');
	$attributes=array('legend'=>false,'value'=>'M',);
	echo $this->Form->radio('sexe',$options,$attributes);?>

	<?php echo $this->Form->input('mail',array('label'=>"Votre mail"));?>
	<?php echo $this->Form->input('mot_de_passe',array('label'=>"Mot de passe"));?>
	<?php echo $this->Form->input('photo_file', array('label'=>'Votre photo (format : jpg ou png)','type'=>'file')) ?>
<?php echo $this->Form->end("S'enregistrer");?> 