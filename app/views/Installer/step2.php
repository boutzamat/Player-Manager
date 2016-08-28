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
			<h1 class="page-header">Step 2: Back-end data</h1>
			<form action="index.php?controller=Installer&amp;action=step3&amp;install=1" method="post" id="frmStep2" class="form_install well">
				<input type="hidden" name="step2" value="1" />
				<input type="hidden" name="hostname" value="<?php echo isset($_SESSION[$controller->default_product]['hostname']) ? $_SESSION[$controller->default_product]['hostname'] : NULL; ?>" />
				<input type="hidden" name="username" value="<?php echo isset($_SESSION[$controller->default_product]['username']) ? $_SESSION[$controller->default_product]['username'] : NULL; ?>" />
				<input type="hidden" name="password" value="<?php echo isset($_SESSION[$controller->default_product]['password']) ? $_SESSION[$controller->default_product]['password'] : NULL; ?>" />
				<input type="hidden" name="database" value="<?php echo isset($_SESSION[$controller->default_product]['database']) ? $_SESSION[$controller->default_product]['database'] : NULL; ?>" />
				<input type="hidden" name="prefix" value="<?php echo isset($_SESSION[$controller->default_product]['prefix']) ? $_SESSION[$controller->default_product]['prefix'] : NULL; ?>" />
			
				<p><label class="title">Email <span class="red">*</span></label> <input type="text" name="admin_username" class="required email form-control" /></p>
				<p><label class="title">Password <span class="red">*</span></label> <input type="text" name="admin_password" class="required form-control" /></p>
				<p>
					<button type="button" class="btn btn-default" onclick="window.location='index.php?controller=Installer&amp;action=step1'" /><span class="glyphicon glyphicon-arrow-left"></span> Back</button>
					<button type="submit" class="btn btn-success" /><span class="glyphicon glyphicon-ok"></span> Finish</button>
				</p>
			
			</form>
			<?php
			if (isset($tpl['warning']))
			{
				switch ($tpl['warning'])
				{
					case 4:
						?>
						<div class="alert alert-warning">
							<h3>Warning</h3>
							<p class="form_install">
								If you proceed with the installation your current database and all the data will be deleted.
							</p>
						</div>
						<?php
						break;
				}
			}
			break;
		case 2:
			?>
			<div class="alert alert-danger">
				<h3>Error 2</h3>
				<p class="form_install">
					Can't connect to MySQL server. Please check you data again.
					<br /><br />
					<button type="button" class="btn btn-danger" onclick="window.location='index.php?controller=Installer&action=step1'" /><span class="glyphicon glyphicon-arrow-left"></span> Back</button>
				</p>
			</div>
			<?php
			break;
		case 3:
			?>
			<div class="alert alert-danger">
				<h3>Error 3</h3>
				<p class="form_install">
					Can't select database. Please check you data again.
					<br /><br />
					<button type="button" class="btn btn-danger" onclick="window.location='index.php?controller=Installer&action=step1'" /><span class="glyphicon glyphicon-arrow-left"></span> Back</button>
				</p>
			</div>
			<?php
			break;
		case 7:
			?><p class="form_install"><?php echo $SBS_LANG['status'][7]; ?></p><?php
			break;
	}
}
?>