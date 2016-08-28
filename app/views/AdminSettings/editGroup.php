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
                break;
        }
    }
    ?>
</div>
<?php
$count = count($tpl['group_arr']) + 1;
?>
<table class="cms-table table table-striped" >
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
                        <input type="text" class="text-all form-control" name="group_name"/>
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
                        <a class="icon icon-add-group btn btn-sm btn-default" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=addGroup&amp;id=<?php echo $tpl['group_arr'][$i - 1]['id']; ?>"><?php echo $CMS_LANG['_add']; ?></a>
                    </td>
                    <?php
                } else {
                    ?>
                    <td  class = " <?php echo ($i == 0) ? "first" : " group"; ?>"  axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=updateGroup&amp;id=<?php echo @$tpl['group_arr'][$i - 1]['id']; ?>">
                        <a class="icon icon-edit-group ajax_item_name group btn btn-sm btn-default"  axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=updateGroup&amp;id=<?php echo @$tpl['group_arr'][$i - 1]['id']; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=updateGroup&amp;id=<?php echo $tpl['group_arr'][$i - 1]['id']; ?>"><?php echo $CMS_LANG['_edit']; ?></a>
                    </td>
                <?php } ?>
                <td>
                    <?php if ($i == 0) { ?>
                        &nbsp;
                    <?php } else { ?>
                        <a class="icon icon-delete-group btn btn-sm btn-default" rev="<?php echo $tpl['group_arr'][$i - 1]['id']; ?>" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=deleteGroup&amp;id=<?php echo $tpl['group_arr'][$i - 1]['id']; ?>"><?php echo $CMS_LANG['_delete']; ?></a>
                    <?php } ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>