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
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1"><?php echo $CMS_LANG['section_update']; ?></a></li>
		</ul>
		<div id="tabs-1">

			<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSections&amp;action=update&amp;id=<?php echo $tpl['arr']['id']; ?>" method="post" id="frmUpdateSection" class="cms-form">
				<input type="hidden" name="section_update" value="1" />
				<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
				<p><label class="title"><?php echo $CMS_LANG['section_name']; ?></label><input type="text" name="section_name" id="section_name" value = "<?php echo $tpl['arr']['section_name']; ?>" lang="<?php echo $CMS_LANG['required_field'];?>" class="text w300 required" /></p>
				
				<p><label class="title"><?php echo $CMS_LANG['section_user']; ?></label>
					<select name="user_id[]" id="user_id" class="multiselect" multiple="multiple" <?php echo $controller->isEditor() ? "disabled = 'disabled'" : ""; ?>>
					<?php
					foreach ($tpl['user_arr'] as $v)
					{
						if(isset($tpl['user_id_arr'])){
					
							if (in_array($v['id'], $tpl['user_id_arr']))
							{
								?><option value="<?php echo $v['id']; ?>" selected="selected"><?php echo stripslashes($v['full_name']); ?>, <?php echo stripslashes($v['email']); ?></option><?php
							} else {
								?><option value="<?php echo $v['id']; ?>"><?php echo stripslashes($v['full_name']); ?>, <?php echo stripslashes($v['email']); ?></option><?php
							}
						}else{
							?><option value="<?php echo $v['id']; ?>"><?php echo stripslashes($v['full_name']); ?>, <?php echo stripslashes($v['email']); ?></option><?php
						}
					}
					?>
					</select>
				</p>
				<p>
					<label class="title"><?php echo $CMS_LANG['section_content']; ?></label>
					<textarea rows="10" cols="10" name="section_content" id="section_content" class="text w 500"><?php echo $tpl['arr']['section_content']; ?></textarea>
				</p>
				<p>
					<label class="title">&nbsp;</label>
					<input type="hidden" value="" id="install_folder" name = "install_folder" value = "<?php echo INSTALL_FOLDER;?>" />
					<input type="hidden" value="" id="install_url" name = "install_url" value = "<?php echo INSTALL_URL;?>" />
					<input type="submit" value="" class="button button_save" />
				</p>
			</form>
		</div> <!-- tabs-1 -->
	</div> <!-- tabs -->
	<?php
}
?>