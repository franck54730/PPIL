<?php 

    echo $this->Form->create();
    echo $this->Form->input('nom');
    $options = array('oui' => ' oui','non' => ' non');
    $attributes = array('onChange'=>'this.form.input(\'date\')','legend' => false,'value' => 'non');
    echo $this->Form->input('date',array(
        'dateFormat' =>'DMY',
        'minYear' => date('Y'),
        'empty' => '',
        'selected' => ''
    ));
    echo $this->Form->end('Valider');
 ?>