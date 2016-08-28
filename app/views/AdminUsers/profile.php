<?php
/**
 * @package cms
 * @subpackage cms.app.views.AdminUsers
 */
if (isset($tpl['status'])) {
    switch ($tpl['status']) {
        case 1:
            ?><p class="status_err"><span>&nbsp;</span><?php echo $CMS_LANG['status'][1]; ?></p><?php
            break;
        case 2:
            ?><p class="status_err"><span>&nbsp;</span><?php echo $CMS_LANG['status'][2]; ?></p><?php
            break;
        case 5:
            Util::printNotice($CMS_LANG['status'][5]);
            break;
    }
} else {
    ?>
    <div id="info_list_box">
        <?php echo Util::printNotice($CMS_LANG['user_profile_info']); ?>
    </div>
    <?php
    if (isset($_GET['err'])) {
        switch ($_GET['err']) {
            case 5:
                Util::printNotice($CMS_LANG['user_err'][5]);
                break;
             case 6:
                Util::printNotice($CMS_LANG['user_err'][6]);
                break;
        }
    }
    ?>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1"><?php echo $CMS_LANG['user_update_profile']; ?></a></li>
        </ul>
        <div id="tabs-1">

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&amp;action=profile" method="post" id="frmUpdateUser" class="cms-form">
                <input type="hidden" name="update_profile" value="1" />
                <input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
                <p><label class="title"><?php echo $CMS_LANG['user_full_name']; ?></label><input type="text" name="full_name" id="full_name" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['full_name'])); ?>" class="text w150 required" /></p>
                <?php
                if ($controller->isUser()) {
                    ?>
                    <p><label class="title"><?php echo $CMS_LANG['team']; ?></label>
                        <?php echo $CMS_LANG['team_name']; ?>
                    </p>
                    <?php
                }
                ?>
                <p><label class="title"><?php echo $CMS_LANG['user_email']; ?></label><input type="text" name="email" id="email" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['email'])); ?>" class="text w300 required email" /></p>
                <p><label class="title"><?php echo $CMS_LANG['user_password']; ?></label><input type="password" name="password" id="password" value="password" class="text w150 required" /></p>
                <p>
                    <label class="title">&nbsp;</label>
                    <input type="submit" value="" class="button button_save" />
                </p>
            </form>
        </div> <!-- tabs-1 -->
    </div> <!-- tabs -->
    <?php
}
?>