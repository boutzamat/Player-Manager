<?php
require_once FRAMEWORK_PATH . 'Controller.class.php';
/**
 * App controller
 *
 * @package cms
 * @subpackage cms.app.controllers
 */
class AppController extends Controller
{
/**
 * Model's cache
 *
 * @var array
 * @access protected
 */
	var $models = array();

/**
 * Multi user support
 *
 * @var bool
 * @access private
 */
	var $multiUser = true;
/**
 * Check if multi-user support is enabled
 *
 * @return bool
 * @access public
 */
	function isMultiUser()
	{
		return $this->multiUser;
	}
/**
 * Check loged user against 'owner' role
 *
 * @access public
 * @return bool
 */
	function isEditor()
    {
    	return $this->getRoleId() == 2;
    }
    
/**
 * Check option data is existed or not
 * @return bool
 */ 
    function hasOption(){
    	Object::import('Model', array('Option'));
		$OptionModel = new OptionModel();
		return $OptionModel->checkOptionExist();
    }   
}
?>