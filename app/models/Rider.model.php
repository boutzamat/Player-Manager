<?php

require_once MODELS_PATH . 'App.model.php';

class RiderModel extends AppModel {
    
    var $primaryKey = 'id';

    var $table = 'simple_cms_riders';

    var $schema = array(
        array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
        array('name' => 'user_id', 'type' => 'int', 'default' => ''),
        array('name' => 'team_id', 'type' => 'int', 'default' => ''),
        array('name' => 'group_id', 'type' => 'int', 'default' => ''),
        array('name' => 'number', 'type' => 'int', 'default' => ''),
        array('name' => 'rider_name', 'type' => 'varchar', 'default' => ''),
        array('name' => 'q_1', 'type' => 'tinyint', 'default' => ''),
        array('name' => 'q_2', 'type' => 'tinyint', 'default' => ''),
        array('name' => 'q_3', 'type' => 'tinyint', 'default' => ''),
        array('name' => 'f_sm', 'type' => 'tinyint', 'default' => ''),
        array('name' => 'f_dm', 'type' => 'tinyint', 'default' => '')
    );
}

?>