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
    <div id="message_box">
        <?php
        if (isset($tpl['err'])) {
            switch ($tpl['err']) {
                case 1:
                    Util::printNotice($CMS_LANG['settings_err'][1]);
                    break;
                case 2:
                    Util::printNotice($CMS_LANG['settings_err'][2]);
                    break;
                case 3:
                    Util::printNotice($CMS_LANG['settings_err'][3]);
                    break;
                case 4:
                    Util::printNotice($CMS_LANG['settings_err'][4]);
                    break;
                case 5:
                    Util::printNotice($CMS_LANG['settings_err'][5]);
                    break;
                case 6:
                Util::printNotice($CMS_LANG['settings_err'][6]);
                break;
                case 7:
                    Util::printNotice($CMS_LANG['settings_err'][7]);
                    break;
                case 8:
                    Util::printNotice($CMS_LANG['settings_err'][8]);
                    break;
                case 9:
                    Util::printNotice($CMS_LANG['settings_err'][9]);
                    break;
                case 10:
                    Util::printNotice($CMS_LANG['settings_err'][10]);
            }
        }
        ?>
    </div>
    <div id="tabs" class="tab-user-general">
        <ul>
            <li><a href="#tabs-1"><?php echo $CMS_LANG['settings_teams']; ?></a></li>
            <li><a href="#tabs-2"><?php echo $CMS_LANG['settings_groups']; ?></a></li>
        </ul>
        <div id="tabs-1">
            <?php
            $count = count($tpl['team_arr']) + 1;
            ?>
            <div id="table_team_id">
                <table class="cms-table" >
                    <thead>
                        <tr>
                            <th class="sub" width="60%"><?php echo $CMS_LANG['team']; ?></th>
                            <th class="sub"><?php echo $CMS_LANG['team_from']; ?></th>
                            <th class="sub"><?php echo $CMS_LANG['team_to']; ?></th>
                            <th class="sub" width= "10%"></th>
                            <th class="sub" width= "10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < $count; $i++) {
                            ?>
                            <tr class="<?php echo $i % 2 === 0 ? 'odd' : 'even'; ?>">
                                <td class = "<?php echo ($i == 0) ? "first" : "ajax_item_name"; ?>" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=updateTeam&amp;id=<?php echo @$tpl['team_arr'][$i - 1]['id']; ?>">
                                    <?php
                                    if ($i == 0) {
                                        ?>
                                        <input type="text" class="text-all" name="team_name"/>
                                        <?php
                                    } else {
                                        echo stripslashes($tpl['team_arr'][$i - 1]['team_name']);
                                    }
                                    ?>
                                </td>
                                <td class = " <?php echo ($i == 0) ? "first" : "ajax_item_name"; ?>" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=updateTeam&amp;id=<?php echo @$tpl['team_arr'][$i - 1]['id']; ?>">
                                    <?php
                                    if ($i == 0) {
                                        ?>
                                        <input type="text" class="text-all" name="number_from"/>
                                        <?php
                                    } else {
                                        echo stripslashes($tpl['team_arr'][$i - 1]['number_from']);
                                    }
                                    ?>
                                </td>
                                <td class = " <?php echo ($i == 0) ? "first" : "ajax_item_name"; ?>" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=updateTeam&amp;id=<?php echo @$tpl['team_arr'][$i - 1]['id']; ?>">
                                    <?php
                                    if ($i == 0) {
                                        ?>
                                        <input type="text" class="text-all" name="number_to"/>
                                        <?php
                                    } else {
                                        echo stripslashes($tpl['team_arr'][$i - 1]['number_to']);
                                    }
                                    ?>
                                </td>
                                <?php
                                if ($i == 0) {
                                    ?>
                                    <td>
                                        <a class="icon icon-add" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=addTeam&amp;id=<?php echo $tpl['team_arr'][$i - 1]['id']; ?>"><?php echo $CMS_LANG['_add']; ?></a>
                                    </td>
                                    <?php
                                } else {
                                    ?>
                                    <td>
                                        <a class="icon icon-edit ajax_item_name" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=updateTeam&amp;id=<?php echo @$tpl['team_arr'][$i - 1]['id']; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=updateTeam&amp;id=<?php echo $tpl['team_arr'][$i - 1]['id']; ?>"><?php echo $CMS_LANG['_edit']; ?></a>
                                    </td>
                                <?php } ?>
                                <td>
                                    <?php if ($i == 0) { ?>
                                        &nbsp;
                                    <?php } else { ?>
                                        <a class="icon icon-delete" rev="<?php echo $tpl['team_arr'][$i - 1]['id']; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=deleteTeam&amp;id=<?php echo $tpl['team_arr'][$i - 1]['id']; ?>"><?php echo $CMS_LANG['_delete']; ?></a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                if (isset($tpl['team_paginator'])) {
                    ?>
                    <ul class="cms-paginator">
                        <?php
                        for ($i = 1; $i <= $tpl['team_paginator']['pages']; $i++) {
                            if ((isset($_GET['page']) && (int) $_GET['page'] == $i) || (!isset($_GET['page']) && $i == 1)) {
                                ?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;page=<?php echo $i; ?>" class="focus"><?php echo $i; ?></a></li><?php
            } else {
                                ?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
            }
        }
                        ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
            <?php
            if (!$controller->isAjax()) {
                ?>
                <div id="dialogDelete" title="<?php echo htmlspecialchars($CMS_LANG['team_del_title']); ?>" style="display:none">
                    <p><?php echo $CMS_LANG['team_del_body']; ?></p>
                </div>
                <?php
            }
            ?>
            <div id="record_id" style="display:none"></div>

        </div> <!-- tabs-1 -->
        <div id="tabs-2">
            <?php
            $count = count($tpl['group_arr']) + 1;
            ?>
            <div id="table_group_id">
                <table class="cms-table" >
                    <thead>
                        <tr>
                            <th class="sub"><?php echo $CMS_LANG['group']; ?></th>
                            <th class="sub" width= "10%"></th>
                            <th class="sub" width= "10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < $count; $i++) {
                            ?>
                            <tr class="<?php echo $i % 2 === 0 ? 'odd' : 'even'; ?>">
                                <td class = " <?php echo ($i == 0) ? "first" : "ajax_item_name group"; ?>" axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=updateGroup&amp;id=<?php echo @$tpl['group_arr'][$i - 1]['id']; ?>">
                                    <?php
                                    if ($i == 0) {
                                        ?>
                                        <input type="text" class="text-all" name="group_name"/>
                                        <?php
                                    } else {
                                        echo stripslashes($tpl['group_arr'][$i - 1]['group_name']);
                                    }
                                    ?>
                                </td>
                                <?php
                                if ($i == 0) {
                                    ?>
                                    <td>
                                        <a class="icon icon-add-group" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=addGroup&amp;id=<?php echo $tpl['group_arr'][$i - 1]['id']; ?>"><?php echo $CMS_LANG['_add']; ?></a>
                                    </td>
                                    <?php
                                } else {
                                    ?>
                                    <td  class = " <?php echo ($i == 0) ? "first" : " group"; ?>"  axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=updateGroup&amp;id=<?php echo @$tpl['group_arr'][$i - 1]['id']; ?>">
                                        <a class="icon icon-edit-group ajax_item_name group"  axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=updateGroup&amp;id=<?php echo @$tpl['group_arr'][$i - 1]['id']; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=updateGroup&amp;id=<?php echo $tpl['group_arr'][$i - 1]['id']; ?>"><?php echo $CMS_LANG['_edit']; ?></a>
                                    </td>
                                <?php } ?>
                                <td>
                                    <?php if ($i == 0) { ?>
                                        &nbsp;
                                    <?php } else { ?>
                                        <a class="icon icon-delete-group" rev="<?php echo $tpl['group_arr'][$i - 1]['id']; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=deleteGroup&amp;id=<?php echo $tpl['group_arr'][$i - 1]['id']; ?>"><?php echo $CMS_LANG['_delete']; ?></a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            if (!$controller->isAjax()) {
                ?>
                <div id="dialogDeleteGroup" title="<?php echo htmlspecialchars($CMS_LANG['group_del_title']); ?>" style="display:none">
                    <p><?php echo $CMS_LANG['group_del_body']; ?></p>
                </div>
                <?php
            }
            ?>
            <div id="record_id" style="display:none"></div>
            <?php
            if (isset($tpl['group_paginator'])) {
                ?>
                <ul class="cms-paginator">
                    <?php
                    for ($i = 1; $i <= $tpl['group_paginator']['pages']; $i++) {
                        if ((isset($_GET['page']) && (int) $_GET['page'] == $i) || (!isset($_GET['page']) && $i == 1)) {
                            ?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;page=<?php echo $i; ?>" class="focus"><?php echo $i; ?></a></li><?php
            } else {
                            ?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
            }
        }
                    ?>
                </ul>
                <?php
            }
            ?>
        </div> <!-- tabs-2 -->
    </div>
    <?php
}
?>