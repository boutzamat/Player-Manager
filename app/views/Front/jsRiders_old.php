<form id="frmSearch" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="cms-form b10">
    <input type="hidden" name="controller" value="Front" />
    <input type="hidden" name="action" value="jsRiders" />
    
    <p><?php echo $tpl['option_arr']['info_box']; ?></p>
    
    <label class="title"> <?php echo $CMS_LANG['sort_by']; ?></label>
    <label class="title"> <?php echo $CMS_LANG['filter_by_team']; ?></label>
    <label class="title margin-left35"> <?php echo $CMS_LANG['filter_by_group']; ?></label>
    <br />
    <select name="sort" class="select" id="sort_id">
        <option value=""><?php echo $CMS_LANG['sort_by']; ?></option>
        <?php
        foreach ($CMS_LANG['sort'] as $k => $v) {
            ?>
            <option value="<?php echo $k; ?>" <?php echo (isset($_REQUEST['sort']) && $_REQUEST['sort'] == $k) ? "selected='selected'" : ""; ?>><?php echo $v; ?></option>
            <?php
        }
        ?>
    </select>

    <select name="filter" class="select select-margin" id="filter_id">
        <option value=""><?php echo $CMS_LANG['filter_by_team']; ?></option>
        <?php
        foreach ($tpl['team_arr'] as $k => $v) {
            ?>
            <option value="<?php echo $v['id']; ?>" <?php echo (isset($_REQUEST['filter']) && $_REQUEST['filter'] == $v['id']) ? "selected='selected'" : ""; ?>><?php echo $v['team_name']; ?></option>
            <?php
        }
        ?>
    </select>

    <select name="group_filter" class="select select-margin" id="group_filter_id">
        <option value=""><?php echo $CMS_LANG['filter_by_group']; ?></option>
        <?php
        foreach ($tpl['group_arr'] as $k => $v) {
            ?>
            <option value="<?php echo $v['id']; ?>" <?php echo (isset($_REQUEST['group_filter']) && $_REQUEST['group_filter'] == $v['id']) ? "selected='selected'" : ""; ?>><?php echo $v['group_name']; ?></option>
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
    <table class="cms-table"  cellspacing="0" rowspacing="10">
        <thead>
            <tr>
                <th class="sub" style="width: 167px;"><?php echo $CMS_LANG['team_name']; ?></th>
                <th class="sub" style="width: 157px;"><?php echo $CMS_LANG['rider_group']; ?></th>
                <th class="sub" style="width: 37px;"><?php echo $CMS_LANG['rider_#']; ?></th>
                <th class="sub" style="width: 257px;"><?php echo $CMS_LANG['name']; ?></th>
                <th class="sub" colspan="3" style="width: 157px;"><?php echo $CMS_LANG['rider_qualification']; ?></th>
                <th class="sub" colspan="2" style="width: 149px;"><?php echo $CMS_LANG['rider_final']; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < $count; $i++) {
                ?>
                <tr class="<?php echo $i % 2 === 0 ? 'odd' : 'even'; ?>">
                    <td class="t-gray">
                        <?php
                        echo stripslashes($tpl['arr'][$i]['team_name']);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo stripslashes($tpl['arr'][$i]['group_name']);
                        ?>
                    </td>
                    <td class="t-gray">
                        <?php
                        echo stripslashes($tpl['arr'][$i]['number']);
                        ?>
                    </td>
                    <td>
                        <?php
                        echo stripslashes($tpl['arr'][$i]['rider_name']);
                        ?>
                    </td>
                    <td class="t-gray" colspan="3">

                        <label class="q_finals">
                            <?php
                            if ((!empty($tpl['arr'][$i]['q_1'])) && $tpl['arr'][$i]['q_1'] == '1') {
                                ?>
                                <img src="<?php echo INSTALL_URL . IMG_PATH . 'check.png'; ?>" class="checked"/>
                                <?php
                            } else {
                                ?>
                                <img src="<?php echo INSTALL_URL . IMG_PATH . 'unchecked.png'; ?>" class="checked"/>
                                <?php
                            }
                            echo $CMS_LANG['q_1'];
                            ?>
                        </label>

                        <label class="q_finals">
                            <?php
                            if ((!empty($tpl['arr'][$i]['q_2'])) && $tpl['arr'][$i]['q_2'] == '1') {
                                ?>
                                <img src="<?php echo INSTALL_URL . IMG_PATH . 'check.png'; ?>" class="checked"/>
                                <?php
                            } else {
                                ?>
                                <img src="<?php echo INSTALL_URL . IMG_PATH . 'unchecked.png'; ?>" class="checked"/>
                                <?php
                            }
                            echo $CMS_LANG['q_2'];
                            ?>
                        </label>
                        <label class="q_finals">
                            <?php
                            if ((!empty($tpl['arr'][$i]['q_3'])) && $tpl['arr'][$i]['q_3'] == '1') {
                                ?>
                                <img src="<?php echo INSTALL_URL . IMG_PATH . 'check.png'; ?>" class="checked"/>
                                <?php
                            } else {
                                ?>
                                <img src="<?php echo INSTALL_URL . IMG_PATH . 'unchecked.png'; ?>" class="checked"/>
                                <?php
                            }
                            echo $CMS_LANG['q_3'];
                            ?>
                        </label>
                    </td>
                    <td>
                        <?php
                        if ((!empty($tpl['arr'][$i]['f_sm'])) && $tpl['arr'][$i]['f_sm'] == '1') {
                            ?>
                            <img src="<?php echo INSTALL_URL . IMG_PATH . 'check.png'; ?>" class="checked"/>
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo INSTALL_URL . IMG_PATH . 'unchecked.png'; ?>" class="checked"/>
                            <?php
                        }
                        echo $CMS_LANG['f_sm'];
                        ?>
                    </td>
                    <td disabled="disabled" style="border-right: 2px solid #eff1f2;">
                        <?php
                        if ((!empty($tpl['arr'][$i]['f_dm'])) && $tpl['arr'][$i]['f_dm'] == '1') {
                            ?>
                            <img src="<?php echo INSTALL_URL . IMG_PATH . 'check.png'; ?>" class="checked"/>
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo INSTALL_URL . IMG_PATH . 'unchecked.png'; ?>" class="checked"/>
                            <?php
                        }
                        echo $CMS_LANG['f_dm'];
                        ?>
                    </td>
                </tr>
                <tr><td colspan="9" class="none-border"></td></tr>
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
                    ?><li><a href="#" class="focus" rel="<?php echo $i; ?>" class="pages"><?php echo $i; ?></a></li><?php
            } else {
                    ?><li><a href="#" rel="<?php echo $i; ?>" class="pages"><?php echo $i; ?></a></li><?php
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