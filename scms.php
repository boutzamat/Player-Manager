<?php
if (!isset($_GET['controller']) || empty($_GET['controller'])) 
{ 
	$_GET["controller"] = "Front"; 
}
if (!isset($_GET['action']) || empty($_GET['action'])) 
{ 
	$_GET["action"] = "phpSection"; 
}

$_GET["id"] = $simpleCMS; 

$_GET['layout'] = 'empty';

include dirname(__FILE__) . '/index.php';

?>