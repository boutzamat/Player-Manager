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
			Util::printNotice($CMS_LANG['status'][1]);
			break;
		case 2:
			Util::printNotice($CMS_LANG['status'][2]);
			break;
	}
}else{
	?>
	<form action="" method="post" id="frmInstallCode" class="cms-form">
		<div>
			<p>
				<?php echo $CMS_LANG['section_install_title'];?>: <b><?php echo $tpl['arr']['section_name'];?></b>
			</p>
			<p>
				<label class="title"><b><?php echo $CMS_LANG['section_install_method']; ?>:</b></label>
				<select id="install_method" name = "install_method" class="select w150">
					<option value = "javascript">Javascript</option>
					<option value = "php">PHP</option>
				</select>
			</p>
			<div id="install_js_container">
				<p style = "overflow: hidden">
					<label class="title" style = "float: left;"><b><?php echo $CMS_LANG['section_install_code']; ?>:</b></label>
					<span style = "float: left;">
						<b><?php echo $CMS_LANG['section_install_code_js'][1]; ?>:</b><br/>
						<textarea class="textarea textarea-install w600 h80 overflow">
&lt;script type="text/javascript" src="<?php echo INSTALL_URL . JS_PATH; ?>jabb-0.3.js"&gt;&lt;/script&gt;
&lt;script type="text/javascript" src="<?php echo INSTALL_URL . JS_PATH; ?>scms.js"&gt;&lt;/script&gt;
						</textarea>
						<br/><br/>
						<b><?php echo $CMS_LANG['section_install_code_js'][2]; ?>:</b><br/>
						<textarea class="textarea textarea-install w600 h60 overflow">
&lt;script type="text/javascript" src="<?php echo INSTALL_FOLDER; ?>index.php?controller=Front&amp;action=load&amp;id=<?php echo $tpl['arr']['id']; ?>"&gt;&lt;/script&gt;
						</textarea>
					</span>
				</p>
			</div>
			<div id="install_php_container">
				<p style = "overflow: hidden">
					<label class="title"><b><?php echo $CMS_LANG['section_install_code']; ?>:</b></label>
					<span style = "float: left;">
					
						<b><?php echo $CMS_LANG['section_install_code_php'][2]; ?>:</b><br/>
						<textarea class="textarea textarea-install w600 h80 overflow"">
&lt;?php
$simpleCMS = <?php echo $tpl['arr']['id']; ?>;
require '<?php echo INSTALL_PATH; ?>scms.php'; 
?&gt;
						</textarea>
					</span>
				</p>
			</div>
		</div>
	</form>
	<?php
} 
?>