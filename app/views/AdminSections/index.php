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
			Util::printNotice($CMS_LANG['status'][1]);
			break;
		case 2:
			Util::printNotice($CMS_LANG['status'][2]);
			break;
	}
} else {
	?>
	<div id="info_list_box">
		<?php echo Util::printNotice($CMS_LANG['section_list_info']); ?>
	</div>
	<div id="info_add_box">
		<?php echo Util::printNotice($CMS_LANG['section_add_info']); ?>
	</div>
	<div id="info_install_box">
		<?php echo Util::printNotice($CMS_LANG['section_install_info']); ?>
	</div>
	<div id="message_box">
	<?php
	if (isset($_GET['err']))
	{
	
		switch ($_GET['err'])
		{
			case 1:
				Util::printNotice($CMS_LANG['section_err'][1]);
				break;
			case 2:
				Util::printNotice($CMS_LANG['section_err'][2]);
				break;
			case 3:
				Util::printNotice($CMS_LANG['section_err'][3]);
				break;
			case 4:
				Util::printNotice($CMS_LANG['section_err'][4]);
				break;
			case 5:
				Util::printNotice($CMS_LANG['section_err'][5]);
				break;
			case 7:
				Util::printNotice($CMS_LANG['status'][7]);
				break;
			case 8:
				Util::printNotice($CMS_LANG['section_err'][8]);
				break;
			case 9:
				Util::printNotice($CMS_LANG['section_err'][9]);
				break;
			case 10:
				Util::printNotice($CMS_LANG['section_err'][10]);
				break;
			case 11:
				Util::printNotice($CMS_LANG['section_err'][11]);
				break;
		}
	}
	?>
	</div>
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1"><?php echo $CMS_LANG['section_list']; ?></a></li>
			<?php
			if($tpl['add_allow'] == true)
			{ 
				?><li><a href="#tabs-2"><?php echo $CMS_LANG['section_create']; ?></a></li><?php
			} 
			
			if($tpl['install_delete_allow'] == true)
			{ 
				?>
			<li id="install-tab-header" style = "display:none;"><a href="#tabs-3"><?php echo $CMS_LANG['section_install']; ?></a></li>
				<?php
			} 
			?>
		</ul>
		<div id="tabs-1">
		
			<form id="frmSearch" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="cms-form b10">
				<input type="hidden" name="controller" value="AdminSections" />
				<input type="hidden" name="action" value="index" />
				<span>
					<input type="text" name="q" value="<?php echo isset($_GET['q']) && !empty($_GET['q']) ? htmlspecialchars($_GET['q']) : NULL; ?>" class="text w300" />
					<input type="submit" value="" class="button button_search" />
				</span>
				<div style = "clear: both;"></div>
			</form>
			<?php
			if (isset($tpl['arr']))
			{
				if (is_array($tpl['arr']))
				{
					$count = count($tpl['arr']);
					if ($count > 0)
					{
						?>
						<table class="cms-table" cellpadding="0" cellspacing="0">
							<thead>
								<tr>
									<th class="sub"><?php echo $CMS_LANG['section_name']; ?></th>
									
									<?php
									if($tpl['install_delete_allow'] == true)
									{ 
										?>
										<th class="sub" style="width: 8%"></th>
										<?php
									} 
									if($tpl['add_allow'] == true)
									{ 
										?>
										<th class="sub" style="width: 8%"></th>
										<?php
									} 
									?>
									<th class="sub" style="width: 8%"></th>
									<?php 
									if($tpl['install_delete_allow'] == true)
									{ 
										?>
										<th class="sub" style="width: 8%"></th>
										<?php
									} 
									?>
								</tr>
							</thead>
							<tbody>
						<?php
						for ($i = 0; $i < $count; $i++)
						{
							?>
							<tr  class="<?php echo $i % 2 === 0 ? 'odd' : 'even'; ?>">
								<td class = "scms_item_name" axis="<?php echo  $_SERVER['PHP_SELF']; ?>?controller=AdminSections&amp;action=update&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo stripslashes($tpl['arr'][$i]['section_name']); ?></td>
								<?php
								if($tpl['install_delete_allow'] == true)
								{ 
									?>
									<td><a class="icon icon-install" href="#" rev="<?php echo $tpl['arr'][$i]['id']; ?>" ><?php echo $CMS_LANG['_install']; ?></a></td>
									<?php
								} 
								if($tpl['add_allow'] == true)
								{ 
									?>
									<td><a class="icon icon-duplicate" href="<?php echo  $_SERVER['PHP_SELF']; ?>?controller=AdminSections&amp;action=duplicate&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo $CMS_LANG['_duplicate']; ?></a></td>
									<?php
								} 
								?>
								<td><a class="icon icon-edit" href="<?php echo  $_SERVER['PHP_SELF']; ?>?controller=AdminSections&amp;action=update&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo $CMS_LANG['_edit']; ?></a></td>
								<?php
								if($tpl['install_delete_allow'] == true)
								{ 
									?>
									<td><a class="icon icon-delete" rev="<?php echo $tpl['arr'][$i]['id']; ?>" href="<?php echo  $_SERVER['PHP_SELF']; ?>?controller=AdminSections&amp;action=delete&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo $CMS_LANG['_delete']; ?></a></td>
									<?php
								} 
								?>
							</tr>
							<?php
						}
						?>
							</tbody>
						</table>
						<?php
						if (!$controller->isAjax())
						{
							?>
							<div id="dialogDelete" title="<?php echo htmlspecialchars($CMS_LANG['section_del_title']); ?>" style="display:none">
								<p><?php echo $CMS_LANG['section_del_title']; ?></p>
							</div>
							<?php
						}
						?>
						<div id="record_id" style="display:none"></div>
						<?php
						if (isset($tpl['paginator']))
						{
							?>
							<ul class="cms-paginator">
							<?php
							for ($i = 1; $i <= $tpl['paginator']['pages']; $i++)
							{
								if ((isset($_GET['page']) && (int) $_GET['page'] == $i) || (!isset($_GET['page']) && $i == 1))
								{
									?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;q=<?php echo isset($_GET['q']) && !empty($_GET['q']) ? urlencode($_GET['q']) : NULL; ?>&amp;page=<?php echo $i; ?>" class="focus"><?php echo $i; ?></a></li><?php
								} else {
									?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;q=<?php echo isset($_GET['q']) && !empty($_GET['q']) ? urlencode($_GET['q']) : NULL; ?>&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
								}
							}
							?>
							</ul>
							<?php
						}
						
					} else {
						Util::printNotice($CMS_LANG['section_empty']);
					}
				}
			}
			?>
		</div>
		<?php
		if($tpl['add_allow'] == true)
		{ 
			?>
			<div id="tabs-2">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSections&amp;action=create" method="post" id="frmCreateSection" class="cms-form">
					<input type="hidden" name="section_create" value="1" />
					<p><label class="title"><?php echo $CMS_LANG['section_name']; ?></label><input type="text" name="section_name" id="section_name" class="text w300 required" lang="<?php echo $CMS_LANG['required_field'];?>" /></p>
					<p><label class="title"><?php echo $CMS_LANG['section_user']; ?></label>
						<select name="user_id[]" id="user_id" class="multiselect" multiple="multiple" <?php echo $controller->isEditor() ? "disabled = 'disabled'" : ""; ?> >
							<?php
							foreach ($tpl['user_arr'] as $v)
							{
								?><option value="<?php echo $v['id']; ?>" <?php echo $v['id'] == 1 ? "selected='selected'" : "";?> ><?php echo stripslashes($v['full_name']); ?>, <?php echo stripslashes($v['email']); ?></option><?php
							}
							?>
						</select>
					</p>
					<p>
						<label class="title"><?php echo $CMS_LANG['section_content']; ?></label>
						<textarea rows="10" cols="10" name="section_content" id="section_content" class="text w 500"></textarea>
					</p>
					<p>
						<label class="title">&nbsp;</label>
						<input type="hidden" id="install_folder" name = "install_folder" value = "<?php echo INSTALL_FOLDER;?>" />
						<input type="hidden" id="install_url" name = "install_url" value = "<?php echo INSTALL_URL;?>" />
						<input type="submit" value="" class="button button_save" />
					</p>
				</form>
			</div>
			<?php
		} 
		if($tpl['install_delete_allow'] == true)
		{ 
			?>
			<div id="tabs-3" style = "display:none;">
				<?php Util::printNotice($CMS_LANG['section_install_note']); ?>
			</div>
			<?php
		} 
		?>
	</div>
	<?php
} 

?>
