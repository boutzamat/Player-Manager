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
        case 9:
            Util::printNotice($CMS_LANG['status'][9]);
            break;
    }
} else {
    ?>
    <div id="tabs" class = "tab-user-update">
        <ul>
            <li><a href="#tabs-1"><?php echo $CMS_LANG['user_update']; ?></a></li>
        </ul>
        <div id="tabs-1">

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&amp;action=update&amp;id=<?php echo $tpl['arr']['id']; ?>" method="post" id="frmUpdateUser" class="cms-form">
                <input type="hidden" name="user_update" value="1" />
                <input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
                <p><label class="title"><?php echo $CMS_LANG['user_role']; ?></label>
                    <select name="role_id" id="role_id" class="select w150 required">
                        <?php
                        foreach ($tpl['role_arr'] as $v) {
                            if ($tpl['arr']['role_id'] == $v['id']) {
                                ?><option value="<?php echo $v['id']; ?>" selected="selected"><?php echo stripslashes($v['role']); ?></option><?php
                } else {
                                ?><option value="<?php echo $v['id']; ?>"><?php echo stripslashes($v['role']); ?></option><?php
                }
            }
                        ?>
                    </select>
                </p>
                <p><label class="title"><?php echo $CMS_LANG['user_team']; ?></label>
                    <select name="team_id" id="team_id" class="select" >
                        <?php
                        foreach ($tpl['team_arr'] as $v) {
                            if ($tpl['arr']['team_id'] == $v['id']) {
                                ?><option value="<?php echo $v['id']; ?>" selected="selected"><?php echo stripslashes($v['team_name']); ?></option><?php
                } else {
                                ?><option value="<?php echo $v['id']; ?>"><?php echo stripslashes($v['team_name']); ?></option><?php
                }
            }
                        ?>
                    </select>
                </p>
                <p><label class="title"><?php echo $CMS_LANG['user_full_name']; ?></label><input type="text" name="full_name" id="full_name" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['full_name'])); ?>" class="text w150 required" /></p>
                <p><label class="title"><?php echo $CMS_LANG['user_phone']; ?></label><input type="text" name="phone" id="phone" class="text w150 required" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['phone'])); ?>"/></p>
                <p><label class="title"><?php echo $CMS_LANG['user_email']; ?></label><input type="text" name="email" id="email" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['email'])); ?>" class="text w300 required email" /></p>
                <p><label class="title"><?php echo $CMS_LANG['user_password']; ?></label><input type="password" name="password" id="password" value="password" class="text w150 required" /></p>

                <p><label class="title"><?php echo $CMS_LANG['user_status']; ?></label>
                    <select name="status" id="status" class="select w150">
                        <?php
                        foreach ($CMS_LANG['user_statarr'] as $k => $v) {
                            if ($k == $tpl['arr']['status']) {
                                echo '<option value="' . $k . '" selected="selected">' . $v . '</option>';
                            } else {
                                echo '<option value="' . $k . '">' . $v . '</option>';
                            }
                        }
                        ?>
                    </select>
                </p>
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