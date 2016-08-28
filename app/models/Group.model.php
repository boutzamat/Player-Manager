<?php

require_once MODELS_PATH . 'App.model.php';

class GroupModel extends AppModel {
    
    var $primaryKey = 'id';

    var $table = 'simple_cms_groups';

    var $schema = array(
        array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
        array('name' => 'group_name', 'type' => 'varchar', 'default' => '')
    );
}
?>