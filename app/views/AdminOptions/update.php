<?php
/**
 * @package cms
 * @subpackage cms.app.views.AdminOptions
 */
if (isset($tpl['status']))
{
	switch ($tpl['status'])
	{
		case 1:
			?><p class="status_err"><span>&nbsp;</span><?php echo $CMS_LANG['status'][1]; ?></p><?php
			break;
		case 2:
			?><p class="status_err"><span>&nbsp;</span><?php echo $CMS_LANG['status'][2]; ?></p><?php
			break;
	}
}
?>