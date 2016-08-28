<?php
/**
 * @package cms
 * @subpackage cms.app.views.AdminSections
 */
if (isset($tpl['status']))
{
	switch ($tpl['status'])
	{
		case 1:
			?><p class="status_err"><?php echo $CMS_LANG['status'][1]; ?></p><?php
			break;
		case 2:
			?><p class="status_err"><?php echo $CMS_LANG['status'][2]; ?></p><?php
			break;
	}
} else {
	include VIEWS_PATH . 'AdminSections/index.php';
}
?>