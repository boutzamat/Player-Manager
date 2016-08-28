<?php
/**
 * @package cms
 * @subpackage cms.app.views.AdminUsers
 */
if (isset($tpl['status'])) {
    switch ($tpl['status']) {
        case 1:
            Util::printNotice($CMS_LANG['status'][1]);
            break;
        case 2:
            Util::printNotice($CMS_LANG['status'][2]);
            break;
        case 9:
            Util::printNotice($CMS_LANG['status'][9]);
            break;
    }
} else {
    ?>
	
	<h1 class="page-header"><?php echo $CMS_LANG['menu_users']; ?></h1>

    <div id="message_box">
        <?php
        if (isset($_GET['err'])) {
            switch ($_GET['err']) {
                case 1:
                    Util::printNotice($CMS_LANG['user_err'][1]);
                    break;
                case 2:
                    Util::printNotice($CMS_LANG['user_err'][2]);
                    break;
                case 3:
                    Util::printNotice($CMS_LANG['user_err'][3]);
                    break;
                case 4:
                    Util::printNotice($CMS_LANG['user_err'][4]);
                    break;
                case 5:
                    Util::printNotice($CMS_LANG['user_err'][5]);
                    break;
                case 7:
                    Util::printNotice($CMS_LANG['status'][7]);
                    break;
                case 8:
                    Util::printNotice($CMS_LANG['user_err'][8]);
                    break;
            }
        }
        ?>
    </div>
    <div id="userTabs"> <!-- id="tabs" class="tab-user-general" -->            
		<?php
            if ($controller->isAdmin()) {
		?>
        <ul class="nav nav-tabs" role="tablist">
            <li class="active" role="presentation"><a href="#tabs-1" aria-controls="home" role="tab" data-toggle="tab"><?php echo $CMS_LANG['user_list']; ?></a></li>
			<li class="" role="presentation"><a href="#tabs-2" aria-controls="home" role="tab" data-toggle="tab"><?php echo $CMS_LANG['user_create']; ?></a></li>
        </ul>
		<?php } ?>
		<div class="tab-content">
			<div id="tabs-1" role="tabpanel" class="tab-pane active">
				<div id="info_list_box">
					<p><?php echo Util::printNotice($CMS_LANG['user_list_info']); ?></p>
				</div>
				<?php
				if (isset($tpl['arr'])) {
					if (is_array($tpl['arr'])) {
						$count = count($tpl['arr']);
						if ($count > 1) {
							?>
							<table class="cms-table table table-striped">
								<thead>
									<tr>
										<th class="sub"><?php echo $CMS_LANG['user_full_name']; ?></th>
										<th class="sub"><?php echo $CMS_LANG['user_team']; ?></th>
										<th class="sub"><?php echo $CMS_LANG['user_phone']; ?></th>
										<th class="sub"><?php echo $CMS_LANG['user_email']; ?></th>
										<?php
										if ($controller->isAdmin()) {
											?>
											<th class="sub" width= "10%"></th>
											<th class="sub" width= "10%"></th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									<?php
									for ($i = 0; $i < $count; $i++) {
										if ($tpl['arr'][$i]['id'] == 1)
											continue;
										?>
										<tr class="<?php echo $i % 2 === 0 ? 'odd' : 'even'; ?>">
											<td class="<?php echo ($controller->isAdmin())?"scms_item_name":""; ?>" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&amp;action=update&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>" ><?php echo stripslashes($tpl['arr'][$i]['full_name']); ?></td>
											<td class="<?php echo ($controller->isAdmin())?"scms_item_name":""; ?>" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&amp;action=update&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>" ><?php echo stripslashes($tpl['arr'][$i]['team_name']); ?></td>
											<td class="<?php echo ($controller->isAdmin())?"scms_item_name":""; ?>" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&amp;action=update&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>" ><a href="tel:<?php echo stripslashes($tpl['arr'][$i]['phone']); ?>"><?php echo stripslashes($tpl['arr'][$i]['phone']); ?></a></td>
											<td class="<?php echo ($controller->isAdmin())?"scms_item_name":""; ?>" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&amp;action=update&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>" ><a href="mailto:<?php echo stripslashes($tpl['arr'][$i]['email']); ?>"><?php echo stripslashes($tpl['arr'][$i]['email']); ?></a></td>
											<?php
											if ($controller->isAdmin()) {
												?>
												<td><a class="icon icon-edit" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&amp;action=update&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo $CMS_LANG['_edit']; ?></a></td>
												<td>
													<?php
													if ($tpl['arr'][$i]['id'] == 1) {
														echo "&nbsp;";
												} else {
														?>
														<a class="icon icon-delete" rev="<?php echo $tpl['arr'][$i]['id']; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&amp;action=delete&amp;id=<?php echo $tpl['arr'][$i]['id']; ?>"><?php echo $CMS_LANG['_delete']; ?></a>
														<?php
												}
													?>
												</td>
											<?php } ?>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
							<?php
							if (isset($tpl['paginator'])) {
								?>
								<ul class="cms-paginator pagination">
									<?php
									for ($i = 1; $i <= $tpl['paginator']['pages']; $i++) {
										if ((isset($_GET['page']) && (int) $_GET['page'] == $i) || (!isset($_GET['page']) && $i == 1)) {
											?><li class="active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
							} else {
											?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
							}
						}
									?>
								</ul>
								<?php
							}

							if (!$controller->isAjax()) {
								?>
								<div id="dialogDelete" title="<?php echo htmlspecialchars($CMS_LANG['user_del_title']); ?>" style="display:none">
									<p><?php echo $CMS_LANG['user_del_body']; ?></p>
								</div>
								<?php
							}
							?>
							<div id="record_id" style="display:none"></div>
							<?php
						} else {
							Util::printNotice($CMS_LANG['user_empty']);
						}
					}
				}
				?>
			</div> <!-- tabs-1 -->
			<?php
				if ($controller->isAdmin()) {
			?>
			<div id="tabs-2" role="tabpanel" class="tab-pane">
				<div id="info_add_box">
					<p><?php echo Util::printNotice($CMS_LANG['user_add_info']); ?></p>
				</div>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminUsers&amp;action=create" method="post" id="frmCreateUser" class="cms-form well">
					<input type="hidden" name="user_create" value="1" />
					<p><label class="title"><?php echo $CMS_LANG['user_role']; ?></label>
						<select name="role_id" id="role_id" class="select w150 required form-control">
							<option value=""><?php echo $CMS_LANG['user_choose']; ?></option>
							<?php
							foreach ($tpl['role_arr'] as $v) {
								?><option value="<?php echo $v['id']; ?>"><?php echo stripslashes($v['role']); ?></option><?php
				}
							?>
						</select>
					</p>
					<p><label class="title"><?php echo $CMS_LANG['user_team']; ?></label>
						<select name="team_id" id="team_id" class="select form-control" >
							<?php
							foreach ($tpl['team_arr'] as $v) {
								?><option value="<?php echo $v['id']; ?>"><?php echo stripslashes($v['team_name']); ?></option><?php
				}
							?>
						</select>
					</p>
					<p><label class="title"><?php echo $CMS_LANG['user_full_name']; ?></label><input type="text" name="full_name" id="full_name" class="text w150 required form-control" /></p>
					<p><label class="title"><?php echo $CMS_LANG['user_phone']; ?></label><input type="text" name="phone" id="phone" class="text w150 required form-control" /></p>
					<p><label class="title"><?php echo $CMS_LANG['user_email']; ?></label><input type="text" name="email" id="email" class="text w300 required email form-control" /></p>
					<p><label class="title"><?php echo $CMS_LANG['user_password']; ?></label><input type="password" name="password" id="password" class="text w150 required form-control" /></p>
					<p><label class="title"><?php echo $CMS_LANG['user_status']; ?></label>
						<select name="status" id="status" class="select w150 form-control">
							<?php
							foreach ($CMS_LANG['user_statarr'] as $k => $v) {
								?><option value="<?php echo $k; ?>"><?php echo $v; ?></option><?php
				}
							?>
						</select>
					</p>
					<p>
						<button type="submit" class="button button_save btn btn-primary" />Create user</button>
					</p>
				</form>
			</div> <!-- tabs-2 --> 
			<?php
				}
			?>
		</div><!-- /tab content -->
    </div>
    <?php
}
?>