<?php
/**
 * @package tsbc
 * @subpackage tsbc.app.views.Installer
 */
if (isset($tpl['status']))
{
	switch ($tpl['status'])
	{
		case 'ok':
			?>
			<h3>Step 1: MySQL server data</h3>
			<form action="index.php?controller=Installer&amp;action=step2&amp;install=1" method="post" id="frmStep1" class="form_install">
				<input type="hidden" name="step1" value="1" />
			
				<p><label class="title">Hostname <span class="red">*</span></label> <input type="text" name="hostname" class="required" value="<?php echo isset($_SESSION[$controller->default_product]['hostname']) ? $_SESSION[$controller->default_product]['hostname'] : 'localhost'; ?>" /></p>
				<p><label class="title">Username <span class="red">*</span></label> <input type="text" name="username" class="required" value="<?php echo isset($_SESSION[$controller->default_product]['username']) ? $_SESSION[$controller->default_product]['username'] : NULL; ?>" /></p>
				<p><label class="title">Password</label> <input type="text" name="password" value="<?php echo isset($_SESSION[$controller->default_product]['password']) ? $_SESSION[$controller->default_product]['password'] : NULL; ?>" /></p>
				<p><label class="title">Database <span class="red">*</span></label> <input type="text" name="database" class="required" value="<?php echo isset($_SESSION[$controller->default_product]['database']) ? $_SESSION[$controller->default_product]['database'] : NULL; ?>" /></p>
				<p><label class="title">Table prefix</label> <input type="text" name="prefix" class="" value="<?php echo isset($_SESSION[$controller->default_product]['prefix']) ? $_SESSION[$controller->default_product]['prefix'] : NULL; ?>" /></p>
				<p><label class="title">&nbsp;</label> <input type="submit" value="Next &gt;&gt;" /></p>
			
			</form>
			
			<img src="http://www.stivasoft.com/trackInstall.php?version=<?php echo SCRIPT_VERSION; ?>&script=<?php echo SCRIPT_ID; ?>" style="display: none" />
			<?php
			break;
		case 1:
			?>
			<h3>Error 1</h3>
			<?php
			foreach ($tpl['err_arr'] as $err)
			{
				?><p class="form_install"><?php
				echo ucfirst($err[0]) . " '<strong>" . $err[1] . "</strong>' is not writable.
				<br /><br />".$err[2]." '<strong>".$err[1]."</strong>'";
				?></p><?php
			}
			break;
		case 7:
			?><p class="form_install"><?php echo $SBS_LANG['status'][7]; ?></p><?php
			break;
	}
}
?>