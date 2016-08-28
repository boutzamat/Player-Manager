<form id="frmSearch" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="cms-form b10">
    <input type="hidden" name="controller" value="AdminRiders" />
    <input type="hidden" name="action" value="serach_riders" />
    <span>
        <input type="text" name="search_str" value="<?php echo isset($_GET['search_str']) && !empty($_GET['search_str']) ? htmlspecialchars($_GET['search_str']) : NULL; ?>" class="text w300" />
        <input type="submit" value="" class="button button_search" id="serach_btn_id"/>
    </span>

    <select name="sort" class="select select-margin">
        <option value=""><?php echo $CMS_LANG['sort_by']; ?></option>
        <?php
        foreach ($CMS_LANG['sort'] as $k => $v) {
            ?>
            <option value="<?php echo $k; ?>" <?php echo (isset($_REQUEST['sort']) && $_REQUEST['sort'] == $k) ? "selected='selected'" : ""; ?>><?php echo $v; ?></option>
            <?php
        }
        ?>
    </select>
    <?php
    if ($controller->isUser()) {
        ?>
        <select name="group_filter" class="select select-margin">
            <option value=""><?php echo $CMS_LANG['filter_by_group']; ?></option>
            <?php
            foreach ($tpl['group_arr'] as $k => $v) {
                ?>
                <option value="<?php echo $v['id']; ?>" <?php echo (isset($_REQUEST['group_filter']) && $_REQUEST['group_filter'] == $v['id']) ? "selected='selected'" : ""; ?>><?php echo $v['group_name']; ?></option>
                <?php
            }
            ?>
        </select>
        <?php
    } else {
        ?>
        <select name="filter" class="select select-margin">
            <option value=""><?php echo $CMS_LANG['filter_by_team']; ?></option>
            <?php
            foreach ($tpl['team_arr'] as $k => $v) {
                ?>
                <option value="<?php echo $v['id']; ?>" <?php echo (isset($_REQUEST['filter']) && $_REQUEST['filter'] == $v['id']) ? "selected='selected'" : ""; ?>><?php echo $v['team_name']; ?></option>
                <?php
            }
            ?>
        </select>
        <select name="group_filter" class="select select-margin">
            <option value=""><?php echo $CMS_LANG['filter_by_group']; ?></option>
            <?php
            foreach ($tpl['group_arr'] as $k => $v) {
                ?>
                <option value="<?php echo $v['id']; ?>" <?php echo (isset($_REQUEST['group_filter']) && $_REQUEST['group_filter'] == $v['id']) ? "selected='selected'" : ""; ?>><?php echo $v['group_name']; ?></option>
                <?php
            }
            ?>
        </select>
        <?php
    }
    ?>

    <div style = "clear: both;"></div>
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
    <table class="cms-table" >
        <thead>
            <tr>
                <th class="sub"><?php echo $CMS_LANG['team_name']; ?></th>
                <th class="sub" width="7%"><?php echo $CMS_LANG['rider_nr']; ?></th>
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
                            <select name="team_id" class="text-all team-selected">
                                <option value="0"><?php echo $CMS_LANG['select_team']; ?></option>
                                <?php
                                foreach ($tpl['team_arr'] as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['team_name']; ?></option>
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
                                <select class="text-all" name="number" id="number_id">
                                    <?php
                                    for ($j = 1; $j <= 9; $j++){
                                        ?>
                                        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                        <?php
                                    }
                                    
                                    if(9 >= $tpl['user_team']['number_from']){
                                        $min = 10;
                                    }else{
                                        $min = $tpl['user_team']['number_from'];
                                    }
                                    
                                    for ($j = $min; $j <= $tpl['user_team']['number_to']; $j++) {
                                        ?>
                                        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                        } elseif ($i == 0) {
                            ?>
                            <input type="text" name="number" class="text-all" id="number_id"/>
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
                            <select name="group_id" class="text-all">
                                <option value="0"><?php echo $CMS_LANG['select_group']; ?></option>
                                <?php
                                foreach ($tpl['group_arr'] as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['group_name']; ?></option>
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
                            <input type="text" class="text-all" name="rider_name"/>
                            <?php
                        } else {
                            echo stripslashes($tpl['arr'][$i - 1]['rider_name']);
                        }
                        ?>
                    </td>
                    <td  >
                        <?php
                        if ($i == 0) {
                            ?>
                            <input class="checkboxClass"  type="checkbox" class="text-all" name="q_1" value="1" data-label="<?php echo $CMS_LANG['q_1']; ?>"/>
                            <?php
                        } else {
                            if (!empty($tpl['arr'][$i - 1]['q_1'])) {
                                ?>
                                <input  class="checkboxClass" type="checkbox" class="text-all" name="q_1" value="1" checked="checked" disabled="disabled" data-label="<?php echo $CMS_LANG['q_1']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input  class="checkboxClass" type="checkbox" class="text-all" name="q_1" value="1" disabled="disabled" data-label="<?php echo $CMS_LANG['q_1']; ?>"/>
                                <?php
                            }
                        }
                        ?>   
                    </td>
                    <td >
                        <?php
                        if ($i == 0) {
                            ?>
                            <input  class="checkboxClass" type="checkbox" class="text-all" name="q_2" value="1" data-label="<?php echo $CMS_LANG['q_2']; ?>"/>
                            <?php
                        } else {
                            if (!empty($tpl['arr'][$i - 1]['q_2'])) {
                                ?>
                                <input class="checkboxClass"  type="checkbox" class="text-all" name="q_2" value="1" checked="checked" disabled="disabled" data-label="<?php echo $CMS_LANG['q_2']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input  class="checkboxClass" type="checkbox" class="text-all" name="q_2" value="1" disabled="disabled" data-label="<?php echo $CMS_LANG['q_2']; ?>"/>
                                <?php
                            }
                        }
                        ?>
                    </td>
                    <td >
                        <?php
                        if ($i == 0) {
                            ?>
                            <input  class="checkboxClass" type="checkbox" class="text-all" name="q_3" value="1" data-label="<?php echo $CMS_LANG['q_3']; ?>"/>
                            <?php
                        } else {
                            if (!empty($tpl['arr'][$i - 1]['q_3'])) {
                                ?>
                                <input  class="checkboxClass" type="checkbox" class="text-all" name="q_3" value="1" checked="checked" disabled="disabled" data-label="<?php echo $CMS_LANG['q_3']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input  class="checkboxClass" type="checkbox" class="text-all" name="q_3" value="1" disabled="disabled" data-label="<?php echo $CMS_LANG['q_3']; ?>"/>
                                <?php
                            }
                        }
                        ?>
                    </td>
                    <td >
                        <?php
                        if ($i == 0) {
                            ?>
                            <input  class="checkboxClass" type="checkbox" class="text-all" name="f_sm" value="1" data-label="<?php echo $CMS_LANG['f_sm']; ?>"/>
                            <?php
                        } else {
                            if (!empty($tpl['arr'][$i - 1]['f_sm'])) {
                                ?>
                                <input class="checkboxClass"  type="checkbox" class="text-all" name="f_sm" value="1" checked="checked" disabled="disabled" data-label="<?php echo $CMS_LANG['f_sm']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input class="checkboxClass"  type="checkbox" class="text-all" name="f_sm" value="1" disabled="disabled" data-label="<?php echo $CMS_LANG['f_sm']; ?>"/>
                                <?php
                            }
                        }
                        ?>
                    </td>
                    <td >
                        <?php
                        if ($i == 0) {
                            ?>
                            <input  class="checkboxClass" type="checkbox" class="text-all" name="f_dm" value="1" data-label="<?php echo $CMS_LANG['f_dm']; ?>" <?php echo ($controller->isUser()) ? 'disabled="disabled"' : ''; ?>/>
                            <?php
                        } else {
                            if (!empty($tpl['arr'][$i - 1]['f_dm'])) {
                                ?>
                                <input class="checkboxClass"  type="checkbox" class="text-all" name="f_dm" value="1" checked="checked" disabled="disabled" data-label="<?php echo $CMS_LANG['f_dm']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input class="checkboxClass"  type="checkbox" class="text-all" name="f_dm" value="1" disabled="disabled" data-label="<?php echo $CMS_LANG['f_dm']; ?>"/>
                                <?php
                            }
                        }
                        ?>
                    </td>
                    <td class = "<?php echo ($i == 0) ? "first" : ""; ?>" >
                        <?php
                        if ($i == 0) {
                            ?>
                            <a class="icon icon-add" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders&amp;action=add"><?php echo $CMS_LANG['_add']; ?></a>
                        <?php } else {
                            ?>
                            <a class="icon icon-edit ajax_item_name" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders&amp;action=update&amp;id=<?php echo @$tpl['arr'][$i - 1]['id']; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders&amp;action=update&amp;id=<?php echo $tpl['arr'][$i - 1]['id']; ?>"><?php echo $CMS_LANG['_edit']; ?></a>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($i == 0) { ?>
                            &nbsp;
                        <?php } else { ?>
                            <a class="icon icon-delete" rev="<?php echo $tpl['arr'][$i - 1]['id']; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminRiders&amp;action=delete&amp;id=<?php echo $tpl['arr'][$i - 1]['id']; ?>"><?php echo $CMS_LANG['_delete']; ?></a>
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
        <ul class="cms-paginator">
            <?php
            for ($i = 1; $i <= $tpl['paginator']['pages']; $i++) {
                if ((isset($_GET['page']) && (int) $_GET['page'] == $i) || (!isset($_GET['page']) && $i == 1)) {
                    ?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=manageRiders&amp;search_str=<?php echo isset($_REQUEST['search_str']) && !empty($_REQUEST['search_str']) ? urlencode($_REQUEST['search_str']) : NULL; ?>&amp;sort=<?php echo isset($_REQUEST['sort']) && !empty($_REQUEST['sort']) ? urlencode($_REQUEST['sort']) : NULL; ?>&amp;filter=<?php echo isset($_REQUEST['filter']) && !empty($_REQUEST['filter']) ? urlencode($_REQUEST['filter']) : NULL; ?>&amp;page=<?php echo $i; ?>" class="focus"><?php echo $i; ?></a></li><?php
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
