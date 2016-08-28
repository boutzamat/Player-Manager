<?php
/**
 * @package cms
 * @subpackage cms.app.views.Layouts.elements
 */
?>
<!doctype html>
<html>
    <head>
        <title>Player Manager</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <?php
        foreach ($controller->css as $css) {
			// Remove default CSS
            // echo '<link type="text/css" rel="stylesheet" href="' . (isset($css['remote']) && $css['remote'] ? NULL : INSTALL_URL) . $css['path'] . htmlspecialchars($css['file']) . '" />';
        }
        foreach ($controller->js as $js) {
            echo '<script type="text/javascript" src="' . (isset($js['remote']) && $js['remote'] ? NULL : INSTALL_URL) . $js['path'] . htmlspecialchars($js['file']) . '"></script>';
        }
		
		echo bootstrap_css();
		echo default_css();
        ?>

    </head>
    <body>
		<header id="header" class="navbar navbar-static-top navbar-default">
			<div class="container">
				<div class="navbar-header">
					<a href="#" id="logo" class="navbar-brand"><img src="<?php echo INSTALL_URL . IMG_PATH; ?>logo.png" alt="" /></a>
				</div>
				
				<?php
				//If normal user
				if ($controller->isUser() or $controller->isAdmin()) {
					?>
					<div class="btn-group navbar-btn pull-right">			
						<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php echo $_SESSION[$controller->default_user]['full_name']; ?> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li>
								<a class="<?php echo $_GET['controller'] == 'AdminUsers' && $_GET['action'] == 'profile' ? 'cms-menu-focus' : NULL; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&action=profile"><span class="glyphicon glyphicon-user"></span> <?php echo $CMS_LANG['menu_user_profile']; ?></a>
							</li>
							<li>
								<a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=Admin&amp;action=logout"><span class="glyphicon glyphicon-log-out"></span> <?php echo $CMS_LANG['menu_logout']; ?></a>
							</li>
						</ul>
					</div>
				<?php }; ?>
				
			</div>
		</header>
        <div id="container">
            <div id="middle" class="container">
				<div class="row clearfix">
					<div id="leftmenu" class="col-sm-3">
						<?php include_once VIEWS_PATH . 'Layouts/elements/leftmenu.php'; ?>
					</div>
					<div id="content" class="col-sm-9">