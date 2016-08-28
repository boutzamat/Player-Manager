<?php
/**
 * @package cms
 * @subpackage cms.app.views.Layouts
 */
?>
<!doctype html>
<html>
    <head>
        <title>Simple CMS | Login</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <?php
        foreach ($controller->css as $css) {
			// Remove default CSS
            // echo '<link type="text/css" rel="stylesheet" href="' . (isset($css['remote']) && $css['remote'] ? NULL : INSTALL_URL) . $css['path'] . $css['file'] . '" />';
        }

        foreach ($controller->js as $js) {
            echo '<script type="text/javascript" src="' . (isset($js['remote']) && $js['remote'] ? NULL : INSTALL_URL) . $js['path'] . $js['file'] . '"></script>';
        }
		
		echo bootstrap_css();
		echo default_css();
        ?>
    </head>
    <body>
		<header id="header" class="navbar navbar-static-top navbar-default">
			<div class="container">
				<div class="navbar-header">
					<a href="#" id="logo" class="navbar-brand" target="_blank"><img src="<?php echo INSTALL_URL . IMG_PATH; ?>logo.png" alt="" /></a>
				</div>
			</div>
		</header>
        <div id="container">
            <div id="middle" class="container">
                <div id="login-content">
					<?php require $content_tpl; ?>
                </div>
            </div> <!-- middle -->
        </div> <!-- container -->
        <div id="footer-wrap" class="sticky-footer">
            <div id="footer" class="container">
                <a href="http://www.simplemedia.dk/" target="_blank">Simple Media.dk</a>
            </div>
        </div>
    </body>
</html>