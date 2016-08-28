<?php
/**
 * @package cms
 * @subpackage cms.app.views.AdminFiles
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
	<div id="info_list_box">
		<?php echo Util::printNotice($CMS_LANG['file_edit_info']); ?>
	</div>

	<div id="tabs" class = "tab-file-update">
		<ul>
			<li><a href="#tabs-1"><?php echo $CMS_LANG['file_update']; ?></a></li>
		</ul>
		<div id="tabs-1">

			<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminFiles&amp;action=update&amp;id=<?php echo $tpl['arr']['id']; ?>" method="post" id="frmUpdateFile" class="cms-form" enctype="multipart/form-data">
				<input type="hidden" name="file_update" value="1" />
				<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
				<p id="file_container" style = "display: <?php echo (file_exists(UPLOAD_PATH . $tpl['arr']['file_name'])) ? "block": "none"; ?>">
					<label class="title"><?php echo $CMS_LANG['file_current_file']; ?>:</label>
					<?php echo $tpl['arr']['file_original_name']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php
					if($tpl['add_allow'] == true)
					{ 
						?>
						<span><a class="icon icon-delete-file" onclick="removeFile(<?php echo $tpl['arr']['id']; ?>);" href="#"><?php echo $CMS_LANG['_delete']; ?></a></span>
						<?php
					} 
					?>						
					<input type="hidden" name="no_file" id="no_file" value = "<?php echo (file_exists(UPLOAD_PATH . $tpl['arr']['file_name'])) ? "no": "yes"; ?>" />
				</p>
				<?php
				
				if(file_exists(UPLOAD_PATH . $tpl['arr']['file_name']))
				{ 
					?>
					<p id="file_url">
						<label class="title"><?php echo $CMS_LANG['file_url']; ?>:</label>
						<a href = "<?php echo INSTALL_URL . UPLOAD_PATH . $tpl['arr']['file_name']?>" target="_blank"><?php echo INSTALL_URL . UPLOAD_PATH . $tpl['arr']['file_name']?></a>
					</p>
					<?php
				}
				if($tpl['add_allow'] == true)
				{ 
					?>
					<p>
						<label class="title"><?php echo $CMS_LANG['file_new_file']; ?>:</label>
						<input type="file" name="file_name" id="file_name" />
					</p>
					
					<p><label class="title"><?php echo $CMS_LANG['file_user']; ?></label>
						<select name="user_id[]" id="user_id" class="multiselect" multiple="multiple" <?php echo $controller->isEditor() ? "disabled = 'disabled'" : ""; ?> >
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
						<label class="title">&nbsp;</label>
						<input type="submit" value="" class="button button_save" />
					</p>
					<?php
				} 
				?>
				
			</form>
		</div> <!-- tabs-1 -->
	</div> <!-- tabs -->
	<?php
	
}
?>