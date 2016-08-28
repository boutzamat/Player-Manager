<?php
if (!defined("ROOT_PATH")) {
    define("ROOT_PATH", dirname(__FILE__) . '/');
}

require_once ROOT_PATH . 'app/config/config.inc.php';

require_once CONTROLLERS_PATH . 'Admin.controller.php';

Object::import('Model', array('Option'));

$OptionModel = new OptionModel();

$sql_statements[0] = "
  INSERT INTO `" . $OptionModel->getTable() . "` 
  (`id`, `key`, `tab_id`, `group`, `value`, `description`, `label`, `type`, `order`) VALUES
  (NULL, 'info_box', 1, NULL, '', 'Info Box', NULL, 'text', 1)";


$flag = true;
for ($i = 0; $i < count($sql_statements); $i++) {

    if (!mysql_query($sql_statements[$i])) {
        $msg = "Failed to submit the query: " . $sql_statements[$i];
        echo $msg;
        $flag = false;
        //return false;
    }
}
if ($flag) {
    echo 'Update successful !';
} else {
    $msg = "Failed to submit the query: ";
    echo $msg;
}
?>
