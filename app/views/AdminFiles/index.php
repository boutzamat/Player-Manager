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
		<?php echo Util::printNotice($CMS_LANG['file_list_info']); ?>
	</div>
	<div id="info_upload_box">
		<?php echo Util::printNotice($CMS_LANG['file_upload_info']); ?>
	</div>
	<div id="message_box">
	<?php
	if (isset($_GET['err']))
	{
		switch ($_GET['err'])
		{
			case 1:
				Util::printNotice($CMS_LANG['file_err'][1]);
				break;
			case 2:
				Util::printNotice($CMS_LANG['file_err'][2]);
				break;
			case 3:
				Util::printNotice($CMS_LANG['file_err'][3]);
				break;
			case 4:
				Util::printNotice($CMS_LANG['file_err'][4]);
				break;
			case 5:
				Util::printNotice($CMS_LANG['file_err'][5]);
				break;
			case 7:
				Util::printNotice($CMS_LANG['status'][7]);
				break;
			case 8:
				Util::printNotice($CMS_LANG['file_err'][8]);
				break;
			case 9:
				Util::printNotice($CMS_LANG['file_err'][9]);
				break;
		}
	}
	?>
	</div>
	<div id="tabs" class="tab-file-general">
		<ul>
			<li><a href="#tabs-1"><?php echo $CMS_LANG['file_list']; ?></a></li>
			<?php
			if($tpl['add_allow'] == true)
			{ 
				?>
				<li><a href="#tabs-2"><?php echo $CMS_LANG['file_create']; ?></a></li>
				<?php
			} 
			?>
		</ul>
		<div id="tabs-1">
		
			<form id="frmSearch" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="cms-form b10">
				<input type="hidden" name="controller" value="AdminFiles" />
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
									<th class="sub"><?php echo $CMS_LANG['file_original_name']; ?></th>
									<th class="sub" width = "8%"></th>
									<?php 
									if($tpl['delete_allow'] == true)
									{ 
										?>
										<th class="sub" width = "8%"></th>
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
							<tr class="<?php echo $i % 2 === 0 ? 'odd' : 'even'; ?>">
								<td class = "scms_item_name" axis="<?php echo  $_SERVER['PHP_SELF']; ?>?controller=AdminFiles&amp;action=update&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>" ><?php echo stripslashes($tpl['arr'][$i]['file_original_name']); ?></td>
								<td><a class="icon icon-edit" href="<?php echo  $_SERVER['PHP_SELF']; ?>?controller=AdminFiles&amp;action=update&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo $CMS_LANG['_edit']; ?></a></td>
								<?php 
								if($tpl['delete_allow'] == true)
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
							<div id="dialogDelete" title="<?php echo htmlspecialchars($CMS_LANG['file_del_title']); ?>" style="display:none">
								<p><?php echo $CMS_LANG['file_del_title']; ?></p>
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
						Util::printNotice($CMS_LANG['file_empty']);
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
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminFiles&amp;action=create" method="post" id="frmCreateFile" class="cms-form" enctype="multipart/form-data" >
					<input type="hidden" name="file_create" value="1" />
					<p>
						<label class="title"><?php echo $CMS_LANG['file_name']; ?>:</label>
						<input type="file" name="file_name" id="file_name" lang="<?php echo $CMS_LANG['required_field'];?>"  />
					</p>
					<p><label class="title"><?php echo $CMS_LANG['file_user']; ?>:</label>
						<select name="user_id[]" id="user_id" class="multiselect" multiple="multiple" <?php echo $controller->isEditor() ? "disabled = 'disabled'" : ""; ?> >
							<?php
							foreach ($tpl['user_arr'] as $v)
							{
								?><option value="<?php echo $v['id']; ?>" <?php echo $v['id'] == 1 ? "selected='selected'" : ""; ?> ><?php echo stripslashes($v['full_name']); ?>, <?php echo stripslashes($v['email']); ?></option><?php
							}
							?>
						</select>
					</p>
				
					<p>
						<label class="title">&nbsp;</label>
						<input type="submit" value="" class="button button_save" />
					</p>
				</form>
			</div>
			<?php
		} 
		?>
	</div>
	<?php
} 
?>