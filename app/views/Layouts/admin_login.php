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
            echo '<link type="text/css" rel="stylesheet" href="' . (isset($css['remote']) && $css['remote'] ? NULL : INSTALL_URL) . $css['path'] . $css['file'] . '" />';
        }

        foreach ($controller->js as $js) {
            echo '<script type="text/javascript" src="' . (isset($js['remote']) && $js['remote'] ? NULL : INSTALL_URL) . $js['path'] . $js['file'] . '"></script>';
        }
        ?>
    </head>
    <body>
        <div id="container">
            <div id="header">
<?php /* <a href="http://www.phpjabbers.com/simple-cms/" id="logo" target="_blank"><img src="<?php echo INSTALL_URL . IMG_PATH; ?>logo.png" alt="Time Slots Booking Calendar" /></a> */ ?>
            </div>
            <div id="middle">
                <div id="login-content">
<?php require $content_tpl; ?>
                </div>
            </div> <!-- middle -->
        </div> <!-- container -->
        <div id="footer-wrap">
            <div id="footer">
                <p><a href="http://www.phpjabbers.com/" target="_blank">PHP Scripts</a> Copyright &copy; <?php echo date("Y"); ?> <a href="http://www.stivasoft.com" target="_blank">StivaSoft Ltd</a></p>
            </div>
        </div>
    </body>
</html>