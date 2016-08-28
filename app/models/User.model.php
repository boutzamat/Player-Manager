<?php
require_once MODELS_PATH . 'App.model.php';
/**
 * User model
 *
 * @package cms
 * @subpackage cms.app.models
 */
class UserModel extends AppModel
{
/**
 * The name of table's primary key. If PK is over 2 or more columns set this to boolean null
 *
 * @var string
 * @access public
 */
	var $primaryKey = 'id';
/**
 * The name of table associate with current model
 *
 * @var string
 * @access protected
 */
	var $table = 'simple_cms_users';
/**
 * Table schema
 *
 * @var array
 * @access protected
 */
	var $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'role_id', 'type' => 'int', 'default' => ''),
                array('name' => 'team_id', 'type' => 'int', 'default' => ''),
		array('name' => 'full_name', 'type' => 'varchar', 'default' => ''),
                array('name' => 'phone', 'type' => 'varchar', 'default' => ''),
		array('name' => 'email', 'type' => 'varchar', 'default' => ''),
		array('name' => 'password', 'type' => 'varchar', 'default' => ''),
		array('name' => 'last_login', 'type' => 'varchar', 'default' => '0'),
		array('name' => 'status', 'type' => 'enum', 'default' => 'T'),
	);
}
?>