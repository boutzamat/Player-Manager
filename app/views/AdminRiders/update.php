<?php

 /*
  *
  * Template for "Edit rider"
  *
  */

?>

<h1 class="page-header"><?php echo $CMS_LANG['menu_manage_riders']; ?></h1>

<form id="frmSearch" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="cms-form b10 row clearfix">
    <input type="hidden" name="controller" value="AdminRiders" />
    <input type="hidden" name="action" value="serach_riders" />
		
	<div class="col-sm-3 form-group">
		<span class="input-group">
			<input type="text" name="search_str" value="<?php echo isset($_GET['search_str']) && !empty($_GET['search_str']) ? htmlspecialchars($_GET['search_str']) : NULL; ?>" class="text w300 form-control" />
			<span class="input-group-btn">
				<button type="submit" class="button button_search btn btn-primary" id="serach_btn_id"><span class="glyphicon glyphicon-search"></span></button>
			</span>
		</span>
	</div>

	<div class="col-sm-3 form-group">
		<select name="sort" class="select select-margin form-control">
			<option value=""><?php echo $CMS_LANG['sort_by']; ?></option>
			<?php
			foreach ($CMS_LANG['sort'] as $k => $v) {
				?>
				<option value="<?php echo $k; ?>" <?php echo (isset($_REQUEST['sort']) && $_REQUEST['sort'] == $k) ? "selected='selected'" : ""; ?>><?php echo $v; ?></option>
				<?php
			}
			?>
		</select>
	</div>
	
	<div class="col-sm-3 form-group">
		<select name="filter" class="select select-margin form-control">
			<option value=""><?php echo $CMS_LANG['filter_by']; ?></option>
			<?php
			foreach ($tpl['team_arr'] as $k => $v) {
				?>
				<option value="<?php echo $v['id']; ?>" <?php echo (isset($_REQUEST['filter']) && $_REQUEST['filter'] == $v['id']) ? "selected='selected'" : ""; ?>><?php echo $v['team_name']; ?></option>
				<?php
			}
			?>
		</select>
	</div>
	
</form>
<?php
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
    <div id="message_box">
        <?php
        if (isset($tpl['err'])) {
            switch ($tpl['err']) {
                case 1:
                    Util::printNotice($CMS_LANG['riders_err'][1]);
                    break;
                case 2:
                    Util::printNotice($CMS_LANG['riders_err'][2]);
                    break;
                case 3:
                    Util::printNotice($CMS_LANG['riders_err'][3]);
                    break;
                case 4:
                    Util::printNotice($CMS_LANG['riders_err'][4]);
                    break;
                case 5:
                    Util::printNotice($CMS_LANG['riders_err'][5]);
                    break;
                case 7:
                    Util::printNotice($CMS_LANG['riders_err'][7]);
                    break;
                case 8:
                    Util::printNotice($CMS_LANG['riders_err'][8]);
                    break;
            }
        }
        ?>
    </div>
    <?php
    $count = count($tpl['arr']) + 1;
    ?>
    <table class="cms-table table table-striped table-condensed" >
        <thead>
            <tr>
                <th class="sub"><?php echo $CMS_LANG['team_name']; ?></th>
                <th class="sub" width= "80"><?php echo $CMS_LANG['rider_nr']; ?></th>
                <th class="sub"><?php echo $CMS_LANG['rider_group']; ?></th>
                <th class="sub"><?php echo $CMS_LANG['rider_name']; ?></th>
                <th class="sub" colspan="3"><?php echo $CMS_LANG['rider_qualification']; ?></th>
                <th class="sub" colspan="2"><?php echo $CMS_LANG['rider_final']; ?></th>
                <th class="sub" width= "5%"></th>
                <th class="sub" width= "5%"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < $count; $i++) {
                ?>
                <tr class="<?php echo $i % 2 === 0 ? 'odd' : 'even'; ?>">
                    <td class = "<?php echo ($i == 0) ? "first" : "ajax_item_name"; ?>" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders&amp;action=update&amp;id=<?php echo @$tpl['arr'][$i - 1]['id']; ?>">
                        <?php
                        if ($i == 0 && $controller->isUser()) {
                            echo "<label style='padding: 3px;'>" . $tpl['user_team']['team_name'] . "</label>";
                        } elseif ($i == 0) {
                            ?>
                            <select name="team_id" class="text-all team-selected form-control" >
                                <option value="0"><?php echo $CMS_LANG['select_team']; ?></option>
                                <?php
                                $from = 0;
                                $to = 0;
                                foreach ($tpl['team_arr'] as $key => $value) {
                                    if ($tpl['rider']['team_id'] == $value['id']) {
                                        $from = $value['number_from'];
                                        $to = $value['number_to'];
                                    }
                                    ?>
                                    <option value="<?php echo $value['id']; ?>" <?php echo ($tpl['rider']['team_id'] == $value['id']) ? "selected='selected'" : ""; ?>><?php echo $value['team_name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php
                        } else {
                            echo stripslashes($tpl['arr'][$i - 1]['team_name']);
                        }
                        ?>
                    </td>
                    <td class = "<?php echo ($i == 0) ? "first" : "ajax_item_name"; ?>" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders&amp;action=update&amp;id=<?php echo @$tpl['arr'][$i - 1]['id']; ?>">
                        <?php
                        if ($i == 0 && $controller->isUser()) {
                            ?>
                            <div class="nr_team">
                                <select class="text-all form-control" name="number" id="number_id">
                                    <?php
                                    for ($j = 1; $j <= 9; $j++){
                                        ?>
                                        <option value="<?php echo $j; ?>"  <?php echo ($tpl['rider']['number'] == $j)?"selected='selected'":""; ?>><?php echo $j; ?></option>
                                        <?php
                                    }

                                    if (9 >= $tpl['user_team']['number_from']){
                                        $min = 10;
                                    } else{
                                        $min = $tpl['user_team']['number_from'];
                                    }
                                    
                                    for ($j = $min; $j <= $tpl['user_team']['number_to']; $j++) {
                                        ?>
                                        <option value="<?php echo $j; ?>" <?php echo ($tpl['rider']['number'] == $j)?"selected='selected'":""; ?>><?php echo $j; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                        } elseif ($i == 0) {
                            ?>
                            <input type="text" name="number" class="text-all form-control" value="<?php echo $tpl['rider']['number']; ?>" id="number_id"/>
                            <?php
                        } else {
                            echo @$tpl['arr'][$i - 1]['number'];
                        }
                        ?>
                    </td>
                    <td class = "<?php echo ($i == 0) ? "first" : "ajax_item_name"; ?>" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders&amp;action=update&amp;id=<?php echo @$tpl['arr'][$i - 1]['id']; ?>">
                        <?php
                        if ($i == 0) {
                            ?>
                            <select name="group_id" class="text-all form-control">
                                <option value="0"><?php echo $CMS_LANG['select_group']; ?></option>
                                <?php
                                foreach ($tpl['group_arr'] as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['id'] ?>" <?php echo ($tpl['rider']['group_id'] == $value['id']) ? "selected='selected'" : ""; ?> ><?php echo $value['group_name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php
                        } else {
                            echo stripslashes($tpl['arr'][$i - 1]['group_name']);
                        }
                        ?>
                    </td>
                    <td class = "<?php echo ($i == 0) ? "first" : "ajax_item_name"; ?>" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders&amp;action=update&amp;id=<?php echo @$tpl['arr'][$i - 1]['id']; ?>">
                        <?php
                        if ($i == 0) {
                            ?>
                            <input type="text" class="text-all form-control" name="rider_name" value="<?php echo $tpl['rider']['rider_name']; ?>"/>
                            <?php
                        } else {
                            echo stripslashes($tpl['arr'][$i - 1]['rider_name']);
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($i == 0) {
                            ?>
                            <input type="checkbox" class="checkboxClass" name="q_1" value="1" <?php echo ($tpl['rider']['q_1'] == '1') ? "checked='checked'" : ""; ?> data-label="<?php echo $CMS_LANG['q_1']; ?>"/>
                            <?php
                        } else {
                            if (!empty($tpl['arr'][$i - 1]['q_1'])) {
                                ?>
                                <input class="checkboxClass" type="checkbox" disabled="disabled" name="" checked="checked" data-label="<?php echo $CMS_LANG['q_1']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input  class="checkboxClass" type="checkbox" disabled="disabled" name="" data-label="<?php echo $CMS_LANG['q_1']; ?>"/>
                                <?php
                            }
                        }
                        ?>   
                    </td>
                    <td>
                        <?php
                        if ($i == 0) {
                            ?>
                            <input type="checkbox" class="checkboxClass" name="q_2" value="1" <?php echo ($tpl['rider']['q_2'] == '1') ? "checked='checked'" : ""; ?>  data-label="<?php echo $CMS_LANG['q_2']; ?>"/>
                            <?php
                        } else {
                            if (!empty($tpl['arr'][$i - 1]['q_2'])) {
                                ?>
                                <input  class="checkboxClass" type="checkbox" disabled="disabled" name="" checked="checked" data-label="<?php echo $CMS_LANG['q_2']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input class="checkboxClass"  type="checkbox" disabled="disabled" name="" data-label="<?php echo $CMS_LANG['q_2']; ?>"/>
                                <?php
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($i == 0) {
                            ?>
                            <input type="checkbox" class="checkboxClass" name="q_3" value="1"  <?php echo ($tpl['rider']['q_3'] == '1') ? "checked='checked'" : ""; ?> data-label="<?php echo $CMS_LANG['q_3']; ?>"/>
                            <?php
                        } else {
                            if (!empty($tpl['arr'][$i - 1]['q_3'])) {
                                ?>
                                <input class="checkboxClass"  type="checkbox" disabled="disabled" name="" checked="checked" data-label="<?php echo $CMS_LANG['q_3']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input class="checkboxClass"  type="checkbox" disabled="disabled" name="" data-label="<?php echo $CMS_LANG['q_3']; ?>"/>
                                <?php
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($i == 0) {
                            ?>
                            <input type="checkbox" class="checkboxClass" name="f_sm" value="1"  <?php echo ($tpl['rider']['f_sm'] == '1') ? "checked='checked'" : ""; ?> data-label="<?php echo $CMS_LANG['f_sm']; ?>"/>
                            <?php
                        } else {
                            if (!empty($tpl['arr'][$i - 1]['f_sm'])) {
                                ?>
                                <input class="checkboxClass"  type="checkbox" disabled="disabled" name="" checked="checked" data-label="<?php echo $CMS_LANG['f_sm']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input class="checkboxClass"  type="checkbox" disabled="disabled" name="" data-label="<?php echo $CMS_LANG['f_sm']; ?>"/>
                                <?php
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($i == 0) {
                            ?>
                            <input type="checkbox" class="checkboxClass" name="f_dm" value="1"  <?php echo ($tpl['rider']['f_dm'] == '1') ? "checked='checked'" : ""; ?> <?php echo ($controller->isUser()) ? 'disabled="disabled"' : ''; ?>  data-label="<?php echo $CMS_LANG['f_dm']; ?>"/>
                            <?php
                        } else {
                            if (!empty($tpl['arr'][$i - 1]['f_dm'])) {
                                ?>
                                <input  class="checkboxClass" type="checkbox" checked="checked" disabled="disabled" name="" data-label="<?php echo $CMS_LANG['f_dm']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input  class="checkboxClass" type="checkbox" disabled="disabled" name="" data-label="<?php echo $CMS_LANG['f_dm']; ?>"/>
                                <?php
                            }
                        }
                        ?>
                    </td>
                    <td >
                        <?php
                        if ($i == 0) {
                            ?>
                            <a class="icon icon-edit ajax-update btn btn-sm btn-default" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders&amp;action=edit&amp;id=<?php echo @$tpl['rider']['id']; ?>"><?php echo $CMS_LANG['_save']; ?></a>
                        <?php } else {
                            ?>
                            <a class="icon icon-edit ajax_item_name btn btn-sm btn-default" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders&amp;action=update&amp;id=<?php echo @$tpl['arr'][$i - 1]['id']; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders&amp;action=update&amp;id=<?php echo $tpl['arr'][$i - 1]['id']; ?>"><?php echo $CMS_LANG['_edit']; ?></a>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($i == 0) { ?>
                            &nbsp;
                        <?php } else { ?>
                            <a class="icon icon-delete btn btn-sm btn-default" rev="<?php echo $tpl['arr'][$i - 1]['id']; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders&amp;action=delete&amp;id=<?php echo $tpl['arr'][$i - 1]['id']; ?>"><?php echo $CMS_LANG['_delete']; ?></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php }
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
                    ?><li class="active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=manageRiders&amp;search_str=<?php echo isset($_REQUEST['search_str']) && !empty($_REQUEST['search_str']) ? urlencode($_REQUEST['search_str']) : NULL; ?>&amp;sort=<?php echo isset($_REQUEST['sort']) && !empty($_REQUEST['sort']) ? urlencode($_REQUEST['sort']) : NULL; ?>&amp;filter=<?php echo isset($_REQUEST['filter']) && !empty($_REQUEST['filter']) ? urlencode($_REQUEST['filter']) : NULL; ?>&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
            } else {
                    ?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=manageRiders&amp;search_str=<?php echo isset($_REQUEST['search_str']) && !empty($_REQUEST['search_str']) ? urlencode($_REQUEST['search_str']) : NULL; ?>&amp;sort=<?php echo isset($_REQUEST['sort']) && !empty($_REQUEST['sort']) ? urlencode($_REQUEST['sort']) : NULL; ?>&amp;filter=<?php echo isset($_REQUEST['filter']) && !empty($_REQUEST['filter']) ? urlencode($_REQUEST['filter']) : NULL; ?>&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
            }
        }
            ?>
        </ul>
        <?php
    }
    if (!$controller->isAjax()) {
        ?>
        <div id="dialogDelete" title="<?php echo htmlspecialchars($CMS_LANG['rider_del_title']); ?>" style="display:none">
            <p><?php echo $CMS_LANG['rider_del_body']; ?></p>
        </div>
        <?php
    }
    ?>
    <div id="record_id" style="display:none"></div>
    <?php
}
?>
