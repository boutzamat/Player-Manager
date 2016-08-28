<?php
require_once MODELS_PATH . 'App.model.php';
/**
 * Option model
 *
 * @package cms
 * @subpackage cms.app.models
 */
class OptionModel extends AppModel
{
/**
 * The name of table's primary key. If PK is over 2 or more columns set this to boolean null
 *
 * @var string
 * @access public
 */
	var $primaryKey = null;
/**
 * The name of table associate with current model
 *
 * @var string
 * @access protected
 */
	var $table = 'simple_cms_options';
/**
 * Table schema
 *
 * @var array
 * @access protected
 */
	var $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'key', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'tab_id', 'type' => 'tinyint', 'default' => ':NULL'),
		array('name' => 'value', 'type' => 'text', 'default' => ':NULL'),
		array('name' => 'description', 'type' => 'text', 'default' => ':NULL'),
		array('name' => 'label', 'type' => 'text', 'default' => ':NULL'),
		array('name' => 'type', 'type' => 'varchar', 'default' => 'string'),
		array('name' => 'order', 'type' => 'int', 'default' => ':NULL')
	);
/**
 * (non-PHPdoc)
 * @see core/framework/Model::get()
 * @param none
 * @param string $key
 * @access public
 * @return array
 */
	function get($key)
	{
		$arr = array();
		$sql_key = $this->escapeString($key);
		$r = mysql_query("SELECT * FROM `".$this->getTable()."` WHERE `key` = '$sql_key' LIMIT 1");
		if (mysql_num_rows($r) == 1)
		{
			$row = mysql_fetch_object($r);
			$f = $this->showColumns($this->getTable());
			for($j = 0; $j < count($f); $j++)
			{
				$arr[$f[$j]['field']] = $row->$f[$j]['field'];
			}
		}
		return $arr;
	}
/**
 * Get array of key => values. Raw version
 *
 * @param none
 * @access public
 * @return array
 */
	function getAllPairs()
	{
		$arr = array();
		$r = mysql_query("SELECT * FROM `".$this->getTable()."`");
		if (mysql_num_rows($r) > 0)
		{
			while ($row = mysql_fetch_object($r))
			{
				$arr[$row->key] = $row->value;
			}
		}
		return $arr;
	}
/**
 * Get array of key => values. Clear special values
 *
 * @param none
 * @access public
 * @return array
 */
	function getPairs()
	{
		$arr = array();
		$r = mysql_query("SELECT * FROM `".$this->getTable()."`");
		if (mysql_num_rows($r) > 0)
		{
			while ($row = mysql_fetch_object($r))
			{
				switch ($row->type)
				{
					case 'enum':
						list(, $arr[$row->key]) = explode("::", $row->value);
						break;
					default:
						$arr[$row->key] = $row->value;
						break;
				}
			}
		}
		return $arr;
	}
	
/**
 *
 * Check to know whether Option table has data or not
 */
	
	function checkOptionExist(){
		$arr = $this->getAll();
		if(!empty($arr)){
			return true;
		}else{
			return false;
		}
	}
}
?>