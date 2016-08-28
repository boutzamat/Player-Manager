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
                    <input type="text" class="text-all form-control" name="group_name" value="<?php echo $tpl['group']['group_name']; ?>"/>
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
                        <a class="icon icon-edit-group ajax-update-group btn btn-sm btn-default" href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=editGroup&amp;id=<?php echo $tpl['group']['id']; ?>"><?php echo $CMS_LANG['_save']; ?></a>
                    </td>
                    <?php
                } else {
                    ?>
                    <td  class = " <?php echo ($i == 0) ? "first" : "ajax_item_name group"; ?>"  axis="<?php echo $_SERVER['PHP_SELF']; ?>?controller=AdminSettings&amp;action=updateGroup&amp;id=<?php echo @$tpl['group_arr'][$i - 1]['id']; ?>">
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