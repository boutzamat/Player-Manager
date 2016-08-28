<?php
/**
 * @package cms
 * @subpackage cms.app.views.Admin
 */
?>
<div class="login-box row clearfix">
	<div class="col-md-6 col-md-offset-3">
		<h3><?php echo $CMS_LANG['login_login']; ?></h3>
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=Admin&amp;action=login" method="post" id="frmLoginAdmin" class="cms-form well">
			<input type="hidden" name="login_user" value="1" />
			<p><label class="title"><?php echo $CMS_LANG['login_email']; ?>:</label><input name="login_email" type="text" class="text w300 form-control" id="login_email" /></p>
			<p><label class="title"><?php echo $CMS_LANG['login_password']; ?>:</label><input name="login_password" type="password" class="text w300 form-control" id="login_password" /></p>
			<p><label class="title">&nbsp;</label><button type="submit" class="button button_login btn btn-primary">Login</button></p>
			<?php
			if (isset($_GET['err']))
			{
				switch ($_GET['err'])
				{
					case 1:
						?><p><label class="title"><?php echo $CMS_LANG['login_error']; ?>:</label><span class="left"><?php echo $CMS_LANG['login_err'][1]; ?></span></p><?php
						break;
					case 2:
						?><p><label class="title"><?php echo $CMS_LANG['login_error']; ?>:</label><span class="left"><?php echo $CMS_LANG['login_err'][2]; ?></span></p><?php
						break;
					case 3:
						?><p><label class="title"><?php echo $CMS_LANG['login_error']; ?>:</label><span class="left"><?php echo $CMS_LANG['login_err'][3]; ?></span></p><?php
						break;
				}
			}
			?>
	</form>
	</div>
</div>