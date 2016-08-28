<?php

// Bootstrap CSS
function bootstrap_css () {
	return '<link id="bootstrap-min-css" type="text/css" rel="stylesheet" href="' . LIBS_PATH . 'bootstrap/css/bootstrap.min.css" />';
}
// Bootstrap JS
function bootstrap_js () {
	return '
	
	<!-- revert global jQuery and $ variables and store jQuery in a new variable -->
	<script type="text/javascript">
		var jQuery_1_8_1 = $.noConflict(true);
	</script>
	
	<!-- load jQuery 1.9.1 -->
	<script type="text/javascript" src="' . LIBS_PATH . 'jquery/jquery-1.9.1.min.js"></script>
	
	<!-- load Bootstrap JS -->
	<script id="bootstrap-min-js" src="' . LIBS_PATH . 'bootstrap/js/bootstrap.min.js" /></script>
	
	';
}
// Custom CSS
function default_css () {
	return '<link id="default-css" type="text/css" rel="stylesheet" href="' . CSS_PATH . 'default.css" />';
}

if (!headers_sent())
{
	//session_name('StivaSoft');
	@session_start();
}
if (!isset($_SERVER['SERVER_ADDR']) && function_exists('gethostbyname'))
{
	$_SERVER['SERVER_ADDR'] = gethostbyname($_SERVER['SERVER_NAME']);
}
if (isset($_SERVER['SERVER_ADDR']) && $_SERVER['SERVER_ADDR'] == '127.0.0.1')
{
	ini_set("display_errors", "On");
	error_reporting(0);
} else {
	error_reporting(0);
}

if(!isset($simpleCMS)){
	header("Content-type: text/html; charset=utf-8");
}
if (!defined("ROOT_PATH"))
{
	define("ROOT_PATH", dirname(__FILE__) . '/');
}

require_once ROOT_PATH . 'app/config/config.inc.php';
if (!isset($_GET['controller']) || empty($_GET['controller']))
{
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: " . INSTALL_URL . basename($_SERVER['PHP_SELF'])."?controller=Admin&action=index");
}

if (isset($_GET['controller']))
{
	if (!is_file(CONTROLLERS_PATH . $_GET['controller'] . '.controller.php'))
	{
		echo 'controller not found';
		exit;
	}
	
	require_once CONTROLLERS_PATH . $_GET['controller'] . '.controller.php';
	if (class_exists($_GET['controller']))
	{
		$controller = new $_GET['controller'];
		
		if (is_object($controller))
		{
			$controller->setDefaultProduct('SimpleCMS');
			$tpl = &$controller->tpl;
			
			if (isset($_GET['action']))
			{
				$action = $_GET['action'];
				if (method_exists($controller, $action))
				{
					$controller->beforeFilter();
					parse_str($_SERVER['QUERY_STRING'], $output);
					unset($output['controller']);
					unset($output['action']);
					$output = array_map("urlencode", $output);
					$params = count($output) > 0 ? "'" . join("','", $output) . "'" : '';
					$str = '$controller->$action('.$params.');';
					eval($str);
					$controller->afterFilter();
					unset($str);
					unset($params);
					$controller->beforeRender();
					$content_tpl = VIEWS_PATH . $_GET['controller'] . '/' . $action . '.php';
				} else {
					echo 'method didn\'t exists';
					exit;
				}
			} else {
				$_GET['action'] = 'index';
				
				$controller->beforeFilter();
				$controller->index();
				$controller->afterFilter();
				$controller->beforeRender();
				$content_tpl = VIEWS_PATH . $_GET['controller'] . '/index.php';
			}
			
			if (!is_file($content_tpl))
			{
				echo 'template not found';
				exit;
			}

			# Language
			require ROOT_PATH . 'app/locale/'. $controller->getLanguage() . '.php';
			
			if ($controller->isAjax())
			{
				require $content_tpl;
				$controller->afterRender();
			} else {
				require VIEWS_PATH . 'Layouts/' . $controller->getLayout() . '.php';
				$controller->afterRender();
			}
		}
	} else {
		echo 'class didn\'t exists';
		exit;
	}
}
?>