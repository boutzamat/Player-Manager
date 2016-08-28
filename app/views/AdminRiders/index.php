<form id="frmSearch" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="cms-form b10">
    <input type="hidden" name="controller" value="AdminRiders" />
    <input type="hidden" name="action" value="search" />
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
    <select name="filter" class="select select-margin">
        <option value=""><?php echo $CMS_LANG['filter_by']; ?></option>
        <?php
        foreach ($tpl['team_arr'] as $k => $v) {
            ?>
            <option value="<?php echo $v['id']; ?>" <?php echo (isset($_REQUEST['filter']) && $_REQUEST['filter'] == $v['id']) ? "selected='selected'" : ""; ?>><?php echo $v['team_name']; ?></option>
            <?php
        }
        ?>
    </select>
    <div style = "clear: both;"></div>
</form>
<?php
$count = count($tpl['arr']);
if ($count > 0) {
    ?>

    <table class="cms-table" >
        <thead>
            <tr>
                <th class="sub"><?php echo $CMS_LANG['team_name']; ?></th>
                <th class="sub"><?php echo $CMS_LANG['rider_nr']; ?></th>
                <th class="sub"><?php echo $CMS_LANG['rider_group']; ?></th>
                <th class="sub"><?php echo $CMS_LANG['rider_name']; ?></th>
                <th class="sub" colspan="3"><?php echo $CMS_LANG['rider_qualification']; ?></th>
                <th class="sub" colspan="2"><?php echo $CMS_LANG['rider_final']; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < $count; $i++) {
                ?>
                <tr class="<?php echo $i % 2 === 0 ? 'odd' : 'even'; ?>">
                    <td>
                        <?php
                        echo stripslashes($tpl['arr'][$i]['team_name']);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo stripslashes($tpl['arr'][$i]['number']);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo stripslashes($tpl['arr'][$i]['group_name']);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo stripslashes($tpl['arr'][$i]['rider_name']);
                        ?>
                    </td>
                    <td>
                        <?php
                        if (!empty($tpl['arr'][$i]['q_1'])) {
                            ?>
                            <input class="checkboxClass" type="checkbox" disabled="disabled" name="q_1" checked="checked" data-label="<?php echo $CMS_LANG['q_1']; ?>"/>
                            <?php
                        } else {
                            ?>
                            <input  class="checkboxClass" type="checkbox" disabled="disabled" name="q_1" data-label="<?php echo $CMS_LANG['q_1']; ?>"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (!empty($tpl['arr'][$i]['q_2'])) {
                            ?>
                            <input  class="checkboxClass" type="checkbox" disabled="disabled" name="q_2" checked="checked" data-label="<?php echo $CMS_LANG['q_2']; ?>"/>
                            <?php
                        } else {
                            ?>
                            <input class="checkboxClass"  type="checkbox" disabled="disabled" name="q_2" data-label="<?php echo $CMS_LANG['q_2']; ?>"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (!empty($tpl['arr'][$i]['q_3'])) {
                            ?>
                            <input class="checkboxClass"  type="checkbox" disabled="disabled" name="q_3" checked="checked" data-label="<?php echo $CMS_LANG['q_3']; ?>"/>
                            <?php
                        } else {
                            ?>
                            <input class="checkboxClass"  type="checkbox" disabled="disabled" name="q_3" data-label="<?php echo $CMS_LANG['q_3']; ?>"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (!empty($tpl['arr'][$i]['f_sm'])) {
                            ?>
                            <input class="checkboxClass"  type="checkbox" disabled="disabled" name="f_sm" checked="checked" data-label="<?php echo $CMS_LANG['f_sm']; ?>"/>
                            <?php
                        } else {
                            ?>
                            <input class="checkboxClass"  type="checkbox" disabled="disabled" name="f_sm" data-label="<?php echo $CMS_LANG['f_sm']; ?>"/>
                            <?php
                        }
                        ?>
                    </td>
                    <td disabled="disabled" >
                        <?php
                        if (!empty($tpl['arr'][$i]['f_dm'])) {
                            ?>
                            <input  class="checkboxClass" type="checkbox" checked="checked" disabled="disabled" name="f_dm" data-label="<?php echo $CMS_LANG['f_dm']; ?>"/>
                            <?php
                        } else {
                            ?>
                            <input  class="checkboxClass" type="checkbox" disabled="disabled" name="f_dm" data-label="<?php echo $CMS_LANG['f_dm']; ?>"/>
                            <?php
                        }
                        ?>
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
                    ?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;search_str=<?php echo isset($_REQUEST['search_str']) && !empty($_REQUEST['search_str']) ? urlencode($_REQUEST['search_str']) : NULL; ?>&amp;sort=<?php echo isset($_REQUEST['sort']) && !empty($_REQUEST['sort']) ? urlencode($_REQUEST['sort']) : NULL; ?>&amp;filter=<?php echo isset($_REQUEST['filter']) && !empty($_REQUEST['filter']) ? urlencode($_REQUEST['filter']) : NULL; ?>&amp;page=<?php echo $i; ?>" class="focus"><?php echo $i; ?></a></li><?php
            } else {
                    ?><li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=<?php echo $_GET['controller']; ?>&amp;action=index&amp;search_str=<?php echo isset($_REQUEST['search_str']) && !empty($_REQUEST['search_str']) ? urlencode($_REQUEST['search_str']) : NULL; ?>&amp;sort=<?php echo isset($_REQUEST['sort']) && !empty($_REQUEST['sort']) ? urlencode($_REQUEST['sort']) : NULL; ?>&amp;filter=<?php echo isset($_REQUEST['filter']) && !empty($_REQUEST['filter']) ? urlencode($_REQUEST['filter']) : NULL; ?>&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
            }
        }
            ?>
        </ul>
        <?php
    }
} else {
    Util::printNotice($CMS_LANG['riders_empty']);
}
?>