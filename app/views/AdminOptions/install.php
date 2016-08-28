<?php
/**
 * @package sbs
 * @subpackage sbs.app.views.AdminOptions
 */
if (isset($tpl['status'])) {
    switch ($tpl['status']) {
        case 1:
            ?><p class="status_err"><span>&nbsp;</span><?php echo $CMS_LANG['status'][1]; ?></p><?php
            break;
        case 2:
            ?><p class="status_err"><span>&nbsp;</span><?php echo $CMS_LANG['status'][2]; ?></p><?php
            break;
    }
} else {
    ?>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1"><?php echo $CMS_LANG['option_install']; ?></a></li>
        </ul>

        <div id="tabs-1">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="sbs-form">
                <p><span class="bold block b10"><?php echo $CMS_LANG['o_install']['js'][1]; ?></span>
                    <textarea class="textarea textarea-install w600 h150 overflow">
    &lt;link href="<?php echo INSTALL_FOLDER . CSS_PATH; ?>front.css" type="text/css" rel="stylesheet" /&gt;
    &lt;script type="text/javascript" src="<?php echo INSTALL_FOLDER . JS_PATH; ?>jabb-0.3.js"&gt;&lt;/script&gt;
    &lt;script type="text/javascript" src="<?php echo INSTALL_FOLDER . JS_PATH; ?>scms.js"&gt;&lt;/script&gt;
                    </textarea></p>
                <p><span class="bold block b10"><?php echo $CMS_LANG['o_install']['js'][2]; ?></span>
                    <textarea class="textarea textarea-install w600 h80 overflow">
    &lt;script type="text/javascript" src="<?php echo INSTALL_FOLDER; ?>index.php?controller=Front&amp;action=load"&gt;&lt;/script&gt;</textarea></p>
               
            </form>
        </div> <!-- tabs-1 -->

    </div>
    <?php
}
?>