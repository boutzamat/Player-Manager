<?php
if (isset($tpl['status'])) {
    switch ($tpl['status']) {
        case 1:
            ?><p class="status_err alert alert-danger"><?php echo $SBS_LANG['status'][1]; ?></p><?php
            break;
        case 2:
            ?><p class="status_err alert alert-danger"><?php echo $SBS_LANG['status'][2]; ?></p><?php
            break;
        case 9:
            Util::printNotice($SBS_LANG['status'][9]);
            break;
    }
} else {
    include VIEWS_PATH . 'AdminRiders/manageRiders.php';
}
?>