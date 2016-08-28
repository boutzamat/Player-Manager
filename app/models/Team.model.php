<?php

require_once MODELS_PATH . 'App.model.php';

class TeamModel extends AppModel {
    
    var $primaryKey = 'id';

    var $table = 'simple_cms_teams';

    var $schema = array(
        array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
        array('name' => 'team_name', 'type' => 'varchar', 'default' => ''),
        array('name' => 'number_from', 'type' => 'varchar', 'default' => ''),
        array('name' => 'number_to', 'type' => 'varchar', 'default' => '')
    );
}

?>