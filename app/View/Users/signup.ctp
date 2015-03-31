<h2>Inscription</h2>

<?php echo $this->Form->create('User'); ?>
	<?php echo $this->Form->input('nom',array('label'=>"Votre nom"));?>
	<?php echo $this->Form->input('prenom',array('label'=>"Votre prénom"));?>
	<?php echo $this->Form->input('date_de_naissance',array('label'=>"Date de naissance"));?>
	<?php echo $this->Form->input('sexe',array('label'=>"F","type"=>'radio',"options" =>array('F' => 'Féminin ')));?>
	<?php echo $this->Form->input('sexe',array('label'=>"M","type"=>'radio',"options" =>array('M' => 'Masculin ')));?>
	<?php echo $this->Form->input('mail',array('label'=>"Votre mail"));?>
	<?php echo $this->Form->input('password',array('label'=>"Mot de passe"));?>
	<?php echo $this->Form->input('photo',array('label'=>"Photo"));?>
<?php echo $this->Form->end("S'enregistrer");?>