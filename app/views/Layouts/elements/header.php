<?php
/**
 * @package cms
 * @subpackage cms.app.views.Layouts.elements
 */
?>
<!doctype html>
<html>
    <head>
        <title>Riders Manager</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <?php
        foreach ($controller->css as $css) {
            echo '<link type="text/css" rel="stylesheet" href="' . (isset($css['remote']) && $css['remote'] ? NULL : INSTALL_URL) . $css['path'] . htmlspecialchars($css['file']) . '" />';
        }
        foreach ($controller->js as $js) {
            echo '<script type="text/javascript" src="' . (isset($js['remote']) && $js['remote'] ? NULL : INSTALL_URL) . $js['path'] . htmlspecialchars($js['file']) . '"></script>';
        }
        ?>
    </head>
    <body>

        <div id="container">
            <div id="header">
<?php /* <a href="http://www.phpjabbers.com/simple-cms/" id="logo" target="_blank"><img src="<?php echo INSTALL_URL . IMG_PATH; ?>logo.png" alt="Time Slots Booking Calendar" /></a> */ ?>
            </div>

            <div id="middle">
                <div id="leftmenu">
<?php include_once VIEWS_PATH . 'Layouts/elements/leftmenu.php'; ?>
                </div>
                <div id="right">
                    <div class="content-top"></div>
                    <div class="content-middle" id="content">