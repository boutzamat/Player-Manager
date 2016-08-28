<?php
/**
 * @package cms
 * @subpackage cms.app.views.Layouts.elements
 */
?>

<?php
if (is_file(INSTALL_PATH . "one-admin.php")) {
    $OneAdmin["pos"] = 'left';
    include(INSTALL_PATH . "one-admin.php");
}
?>	


<div class="leftmenu-top"></div>
<div class="leftmenu-middle">
    <ul class="cms-menu">

        <li><a class="<?php echo $_GET['controller'] == 'AdminRiders' && $_GET['action'] != 'manageRiders' ? 'cms-menu-focus' : NULL; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders"><span class="cms-menu-sections">&nbsp;</span><?php echo $CMS_LANG['menu_listings']; ?></a></li>
        <li><a class="<?php echo $_GET['controller'] == 'AdminRiders' && $_GET['action'] == 'manageRiders' ? 'cms-menu-focus' : NULL; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders&action=manageRiders"><span class="cms-menu-files">&nbsp;</span><?php echo $CMS_LANG['menu_manage_riders']; ?></a></li>
        <?php
        if ($controller->isAdmin()) {
            ?>
            <li><a class="<?php echo $_GET['controller'] == 'AdminSettings' ? 'cms-menu-focus' : NULL; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings"><span class="cms-menu-options">&nbsp;</span><?php echo $CMS_LANG['menu_settings']; ?></a></li>
            <li><a class="<?php echo $_GET['controller'] == 'AdminUsers' && $_GET['action'] != 'profile' ? 'cms-menu-focus' : NULL; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers"><span class="cms-menu-users">&nbsp;</span><?php echo $CMS_LANG['menu_users']; ?></a></li>       
            <?php
        }
        ?>
        <li><a class="<?php echo $_GET['controller'] == 'AdminUsers' && $_GET['action'] == 'profile' ? 'cms-menu-focus' : NULL; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&action=profile"><span class="cms-menu-profile">&nbsp;</span><?php echo $CMS_LANG['menu_user_profile']; ?></a></li>
        <?php
        if ($controller->isAdmin()) {
            /*
              ?><li><a class="<?php echo $_GET['controller'] == 'AdminOptions' && $_GET['action'] == 'index' ? 'cms-menu-focus' : NULL; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminOptions"><span class="cms-menu-options">&nbsp;</span><?php echo $CMS_LANG['menu_options']; ?></a></li>
              <?php */
            ?>
            <li><a class="<?php echo $_GET['controller'] == 'AdminOptions' && $_GET['action'] == 'install' ? 'cms-menu-focus' : NULL; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminOptions&action=install"><span class="cms-menu-install">&nbsp;</span><?php echo $CMS_LANG['menu_install']; ?></a></li>
            <?php
        }
        ?>
        <li><a href="<?php echo INSTALL_URL; ?>preview.php" target="_blank"><span class="cms-menu-preview">&nbsp;</span><?php echo $CMS_LANG['menu_preview']; ?></a></li>
        <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=Admin&amp;action=logout"><span class="cms-menu-logout">&nbsp;</span><?php echo $CMS_LANG['menu_logout']; ?></a></li>
    </ul>
</div>
<div class="leftmenu-bottom"></div>

<?php
if ($controller->isUser()) {
    ?>
    <div class="leftmenu-top"></div>
    <div class="leftmenu-middle">
        <div class="login_details">
            <h2><?php echo $CMS_LANG['login_header']; ?></h2>
            <p>
                <label><?php echo $CMS_LANG['name']; ?>:</label><?php echo $_SESSION[$controller->default_user]['full_name']; ?>
            </p>
            <p>
                <label><?php echo $CMS_LANG['user_team']; ?>:</label><?php echo $_SESSION[$controller->default_user]['team_name']; ?>
            </p>
            <p>
                <label><?php echo $CMS_LANG['user_phone']; ?>:</label><?php echo $_SESSION[$controller->default_user]['phone']; ?>
            </p>
            <p>
                <label><?php echo $CMS_LANG['user_email']; ?>:</label><?php echo $_SESSION[$controller->default_user]['email']; ?>
            </p>
        </div>
    </div>
    <div class="leftmenu-bottom"></div>
<?php } else { ?>
    <div class="leftmenu-top"></div>
    <div class="leftmenu-middle">
        <div class="login_details">
            <h2><?php echo $CMS_LANG['login_as_admin']; ?></h2>
            <p>
                <label><?php echo $CMS_LANG['name']; ?>:</label><?php echo $_SESSION[$controller->default_user]['full_name']; ?>
            </p>
        </div>
    </div>
    <div class="leftmenu-bottom"></div>
<?php } ?>
