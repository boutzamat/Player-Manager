<?php
/**
 * @package sbs
 */
header("Content-type: text/html; charset=utf-8");
if (!defined("ROOT_PATH"))
{
	define("ROOT_PATH", dirname(__FILE__) . '/');
}
require_once ROOT_PATH . 'app/config/config.inc.php';
$id = isset($_GET['id']) && (int) $_GET['id'] > 0 ? (int) $_GET['id'] : NULL;
?>
<!doctype html>
<html>
	<head>
		<title></title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link href="<?php echo INSTALL_FOLDER; ?>app/web/css/front.css" type="text/css" rel="stylesheet" />
                <script type="text/javascript" src="<?php echo INSTALL_FOLDER; ?>app/web/js/jabb-0.3.js"></script>
		<script type="text/javascript" src="<?php echo INSTALL_FOLDER; ?>app/web/js/scms.js"></script>
	</head>
	<body>
		<script type="text/javascript" src="<?php echo INSTALL_FOLDER; ?>index.php?controller=Front&amp;action=load&amp;id=<?php echo $id; ?>"></script>
	</body>
</html>