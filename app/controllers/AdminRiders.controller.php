<?php

require_once CONTROLLERS_PATH . 'Admin.controller.php';

/**
 * AdminUsers controller
 *
 * @package cms
 * @subpackage cms.app.controllers
 */
class AdminRiders extends Admin {

    function index() {
        if ($this->isLoged()) {
            Object::import('Model', 'Option');
            $OptionModel = new OptionModel();
            $option_arr = $OptionModel->getAll();

            foreach ($option_arr as $key => $value) {
                $this->tpl['option_arr'][$value['key']] = $value['value'];
            }

            Object::import('Model', array('Rider', 'Team', 'Group'));
            $RiderModel = new RiderModel();
            $TeamModel = new TeamModel();
            $GroupModel = new GroupModel();

            $opts = array();

            if ($this->isUser()) {
                //$opts['t1.user_id'] = $this->getUserId();
                $this->tpl['user_team'] = $TeamModel->get($this->getUserTeamId());
            }

            $RiderModel->addJoin($RiderModel->joins, $TeamModel->getTable(), 'TM', array('TM.id' => 't1.team_id'), array('TM.team_name'));
            $RiderModel->addJoin($RiderModel->joins, $GroupModel->getTable(), 'GM', array('GM.id' => 't1.group_id'), array('GM.group_name'));
            if (!empty($_REQUEST['sort'])) {
                switch ($_REQUEST['sort']) {
                    case 'team_name_asc':
                        $sort = array('col_name' => 'TM.team_name', 'direction' => 'ASC');
                        break;
                    case 'team_name_desc':
                        $sort = array('col_name' => 'TM.team_name', 'direction' => 'DESC');
                        break;
                    case 'number_asc':
                        $sort = array('col_name' => 't1.number', 'direction' => 'ASC');
                        break;
                    case 'number_desc':
                        $sort = array('col_name' => 't1.number', 'direction' => 'DESC');
                        break;
                    case 'group_name_asc':
                        $sort = array('col_name' => 'GM.group_name', 'direction' => 'ASC');
                        break;
                    case 'group_name_desc':
                        $sort = array('col_name' => 'GM.group_name', 'direction' => 'DESC');
                        break;
                    case 'rider_name_asc':
                        $sort = array('col_name' => 't1.rider_name', 'direction' => 'ASC');
                        break;
                    case 'rider_name_desc':
                        $sort = array('col_name' => 't1.rider_name', 'direction' => 'DESC');
                        break;
                    default:
                        $sort = array();
                        break;
                }
            } else {
                $sort = array();
            }

            if (!empty($_REQUEST['search_str'])) {
                $str = $_REQUEST['search_str'];
                $search['t1.rider_name'] = array("'%%' AND (t1.rider_name LIKE '%$str%' OR TM.team_name LIKE '%$str%' OR GM.group_name LIKE '%$str%' OR t1.number LIKE '%$str%') ", 'LIKE', 'null');
            } else {
                $search = array();
            }

            if (!empty($_REQUEST['filter']) && !empty($_REQUEST['group_filter'])) {
                $filter['t1.team_id'] = $_REQUEST['filter'];
                $filter['t1.group_id'] = $_REQUEST['group_filter'];
            } elseif (!empty($_REQUEST['filter'])) {
                $filter['t1.team_id'] = $_REQUEST['filter'];
            } elseif (!empty($_REQUEST['group_filter'])) {
                $filter['t1.group_id'] = $_REQUEST['group_filter'];
            } else {
                $filter = array();
            }

            $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
            $count = count($RiderModel->getAll(array_merge($opts, $sort, $search, $filter)));
            $row_count = 20;
            $pages = ceil($count / $row_count);
            $offset = ((int) $page - 1) * $row_count;

            $offset_arr = array('offset' => $offset, 'row_count' => $row_count);
            $arr = $RiderModel->getAll(array_merge($opts, $sort, $search, $filter, $offset_arr));

            if (!empty($_GET['err'])) {
                $this->tpl['err'];
            }

            $this->tpl['team_arr'] = $TeamModel->getAll();
            $this->tpl['group_arr'] = $GroupModel->getAll();
            $this->tpl['arr'] = $arr;
            $this->tpl['paginator'] = array('pages' => $pages);

            $this->css[] = array('file' => 'prettyCheckable.css', 'path' => CSS_PATH);
            $this->js[] = array('file' => 'prettyCheckable.js', 'path' => JS_PATH);
            $this->js[] = array('file' => 'adminRider.js', 'path' => JS_PATH);
        } else {
            $this->tpl['status'] = 1;
        }
    }

    function manageRiders() {

        if ($this->isLoged()) {
            Object::import('Model', 'Option');
            $OptionModel = new OptionModel();
            $option_arr = $OptionModel->getAll();

            foreach ($option_arr as $key => $value) {
                $this->tpl['option_arr'][$value['key']] = $value['value'];
            }

            Object::import('Model', array('Rider', 'Team', 'Group'));
            $RiderModel = new RiderModel();
            $TeamModel = new TeamModel();
            $GroupModel = new GroupModel();

            $this->tpl['team_arr'] = $TeamModel->getAll();
            $this->tpl['group_arr'] = $GroupModel->getAll();

            $opts = array();

            if ($this->isUser()) {
                $this->tpl['user_team'] = $TeamModel->get($this->getUserTeamId());
                $opts['t1.team_id'] = $this->getUserTeamId();
            }

            $RiderModel->addJoin($RiderModel->joins, $TeamModel->getTable(), 'TM', array('TM.id' => 't1.team_id'), array('TM.team_name'));
            $RiderModel->addJoin($RiderModel->joins, $GroupModel->getTable(), 'GM', array('GM.id' => 't1.group_id'), array('GM.group_name'));

            if (!empty($_REQUEST['sort'])) {
                switch ($_REQUEST['sort']) {
                    case 'team_name_asc':
                        $sort = array('col_name' => 'TM.team_name', 'direction' => 'ASC');
                        break;
                    case 'team_name_desc':
                        $sort = array('col_name' => 'TM.team_name', 'direction' => 'DESC');
                        break;
                    case 'number_asc':
                        $sort = array('col_name' => 't1.number', 'direction' => 'ASC');
                        break;
                    case 'number_desc':
                        $sort = array('col_name' => 't1.number', 'direction' => 'DESC');
                        break;
                    case 'group_name_asc':
                        $sort = array('col_name' => 'GM.group_name', 'direction' => 'ASC');
                        break;
                    case 'group_name_desc':
                        $sort = array('col_name' => 'GM.group_name', 'direction' => 'DESC');
                        break;
                    case 'rider_name_asc':
                        $sort = array('col_name' => 't1.rider_name', 'direction' => 'ASC');
                        break;
                    case 'rider_name_desc':
                        $sort = array('col_name' => 't1.rider_name', 'direction' => 'DESC');
                        break;
                    default:
                        $sort = array();
                        break;
                }
            } else {
                $sort = array();
            }

            if (!empty($_REQUEST['search_str'])) {
                $str = $_REQUEST['search_str'];
                $search['t1.rider_name'] = array("'%%' AND (t1.rider_name LIKE '%$str%' OR TM.team_name LIKE '%$str%' OR GM.group_name LIKE '%$str%' OR t1.number LIKE '%$str%') ", 'LIKE', 'null');
            } else {
                $search = array();
            }

            if (!empty($_REQUEST['filter']) && !empty($_REQUEST['group_filter'])) {
                $filter['t1.team_id'] = $_REQUEST['filter'];
                $filter['t1.group_id'] = $_REQUEST['group_filter'];
            } elseif (!empty($_REQUEST['filter'])) {
                $filter['t1.team_id'] = $_REQUEST['filter'];
            } elseif (!empty($_REQUEST['group_filter'])) {
                $filter['t1.group_id'] = $_REQUEST['group_filter'];
            } else {
                $filter = array();
            }

            $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
            $count = count($RiderModel->getAll(array_merge($opts, $sort, $search, $filter)));
            $row_count = 20;
            $pages = ceil($count / $row_count);
            $offset = ((int) $page - 1) * $row_count;

            $offset_arr = array('offset' => $offset, 'row_count' => $row_count);
            $arr = $RiderModel->getAll(array_merge($opts, $sort, $search, $filter, $offset_arr));

            $this->tpl['team_arr'] = $TeamModel->getAll();
            $this->tpl['arr'] = $arr;
            $this->tpl['paginator'] = array('pages' => $pages);

            $this->js[] = array('file' => 'jquery.ui.button.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');
            $this->js[] = array('file' => 'jquery.ui.position.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');
            $this->js[] = array('file' => 'jquery.ui.dialog.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');

            $this->css[] = array('file' => 'jquery.ui.button.css', 'path' => LIBS_PATH . 'jquery/ui/css/smoothness/');
            $this->css[] = array('file' => 'jquery.ui.dialog.css', 'path' => LIBS_PATH . 'jquery/ui/css/smoothness/');

            $this->js[] = array('file' => 'jquery.validate.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
            $this->js[] = array('file' => 'jquery.multiselect.min.js', 'path' => LIBS_PATH . 'jquery/');

            $this->css[] = array('file' => 'prettyCheckable.css', 'path' => CSS_PATH);
            $this->js[] = array('file' => 'prettyCheckable.js', 'path' => JS_PATH);

            $this->js[] = array('file' => 'adminRider.js', 'path' => JS_PATH);
        } else {
            $this->tpl['status'] = 1;
        }
    }

    function getTeamNr() {
        $this->isAjax = true;

        if ($this->isXHR()) {
            Object::import('Model', array('Team'));
            $TeamModel = new TeamModel();
            $this->tpl['team'] = $TeamModel->get($_REQUEST['team_id']);
        }
    }

    function addRider() {
        $this->isAjax = true;
        if ($this->isXHR()) {
            Object::import('Model', 'Option');
            $OptionModel = new OptionModel();
            $option_arr = $OptionModel->getAll();

            foreach ($option_arr as $key => $value) {
                $this->tpl['option_arr'][$value['key']] = $value['value'];
            }

            Object::import('Model', array('Rider', 'Team', 'Group'));
            $TeamModel = new TeamModel();
            $RiderModel = new RiderModel();
            $GroupModel = new GroupModel();
            $data = array();

            if (!empty($_REQUEST['q_1']) && $_REQUEST['q_1'] == '1') {
                $data['q_1'] = '1';
            } else {
                $data['q_1'] = '0';
            }
            if (!empty($_REQUEST['q_2']) && $_REQUEST['q_2'] == '1') {
                $data['q_2'] = '1';
            } else {
                $data['q_2'] = '0';
            }
            if (!empty($_REQUEST['q_3']) && $_REQUEST['q_3'] == '1') {
                $data['q_3'] = '1';
            } else {
                $data['q_3'] = '0';
            }
            if (!empty($_REQUEST['f_sm']) && $_REQUEST['f_sm'] == '1') {
                $data['f_sm'] = '1';
            } else {
                $data['f_sm'] = '0';
            }
            if (!empty($_REQUEST['f_dm']) && $_REQUEST['f_dm'] == '1') {
                $data['f_dm'] = '1';
            } else {
                $data['f_dm'] = '0';
            }

            if ($this->isUser()) {
                $data['team_id'] = $this->getUserTeamId();
                $data['user_id'] = $this->getUserId();
            }

            if ((!empty($_REQUEST['team_id']) || !empty($data['team_id'])) && !empty($_REQUEST['number']) && !empty($_REQUEST['group_id']) && !empty($_REQUEST['rider_name'])) {
                $RiderModel->save(array_merge($_REQUEST, $data));
                $this->tpl['err'] = 1;
            } else {
                $this->tpl['err'] = 2;
                $opts = array();

                if ($this->isUser()) {
                    $this->tpl['user_team'] = $TeamModel->get($this->getUserTeamId());
                    $opts['t1.team_id'] = $this->getUserTeamId();
                }
                $RiderModel->addJoin($RiderModel->joins, $TeamModel->getTable(), 'TM', array('TM.id' => 't1.team_id'), array('TM.team_name'));
                $RiderModel->addJoin($RiderModel->joins, $GroupModel->getTable(), 'GM', array('GM.id' => 't1.group_id'), array('GM.group_name'));
                if (!empty($_REQUEST['sort'])) {
                    switch ($_REQUEST['sort']) {
                        case 'team_name_asc':
                            $sort = array('col_name' => 'TM.team_name', 'direction' => 'ASC');
                            break;
                        case 'team_name_desc':
                            $sort = array('col_name' => 'TM.team_name', 'direction' => 'DESC');
                            break;
                        case 'number_asc':
                            $sort = array('col_name' => 't1.number', 'direction' => 'ASC');
                            break;
                        case 'number_desc':
                            $sort = array('col_name' => 't1.number', 'direction' => 'DESC');
                            break;
                        case 'group_name_asc':
                            $sort = array('col_name' => 'GM.group_name', 'direction' => 'ASC');
                            break;
                        case 'group_name_desc':
                            $sort = array('col_name' => 'GM.group_name', 'direction' => 'DESC');
                            break;
                        case 'rider_name_asc':
                            $sort = array('col_name' => 't1.rider_name', 'direction' => 'ASC');
                            break;
                        case 'rider_name_desc':
                            $sort = array('col_name' => 't1.rider_name', 'direction' => 'DESC');
                            break;
                        default:
                            $sort = array();
                            break;
                    }
                } else {
                    $sort = array();
                }

                if (!empty($_REQUEST['search_str'])) {
                    $str = $_REQUEST['search_str'];
                    $search['t1.rider_name'] = array("'%%' AND (t1.rider_name LIKE '%$str%' OR TM.team_name LIKE '%$str%' OR GM.group_name LIKE '%$str%' OR t1.number LIKE '%$str%') ", 'LIKE', 'null');
                } else {
                    $search = array();
                }

                if (!empty($_REQUEST['filter']) && !empty($_REQUEST['group_filter'])) {
                    $filter['t1.team_id'] = $_REQUEST['filter'];
                    $filter['t1.group_id'] = $_REQUEST['group_filter'];
                } elseif (!empty($_REQUEST['filter'])) {
                    $filter['t1.team_id'] = $_REQUEST['filter'];
                } elseif (!empty($_REQUEST['group_filter'])) {
                    $filter['t1.group_id'] = $_REQUEST['group_filter'];
                } else {
                    $filter = array();
                }

                $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
                $count = count($RiderModel->getAll(array_merge($opts, $sort, $search, $filter)));
                $row_count = 20;
                $pages = ceil($count / $row_count);
                $offset = ((int) $page - 1) * $row_count;

                $offset_arr = array('offset' => $offset, 'row_count' => $row_count);

                $arr = $RiderModel->getAll(array_merge($opts, $sort, $search, $filter, $offset_arr));

                $this->tpl['team_arr'] = $TeamModel->getAll();
                $this->tpl['group_arr'] = $GroupModel->getAll();
                $this->tpl['arr'] = $arr;
                $this->tpl['paginator'] = array('pages' => $pages);

                //$this->index();

                return;
            }

            $opts = array();

            if ($this->isUser()) {

                $opts['t1.team_id'] = $this->getUserTeamId();
                $this->tpl['user_team'] = $TeamModel->get($this->getUserTeamId());
            }

            $RiderModel->addJoin($RiderModel->joins, $TeamModel->getTable(), 'TM', array('TM.id' => 't1.team_id'), array('TM.team_name'));
            $RiderModel->addJoin($RiderModel->joins, $GroupModel->getTable(), 'GM', array('GM.id' => 't1.group_id'), array('GM.group_name'));
            if (!empty($_REQUEST['sort'])) {
                switch ($_REQUEST['sort']) {
                    case 'team_name_asc':
                        $sort = array('col_name' => 'TM.team_name', 'direction' => 'ASC');
                        break;
                    case 'team_name_desc':
                        $sort = array('col_name' => 'TM.team_name', 'direction' => 'DESC');
                        break;
                    case 'number_asc':
                        $sort = array('col_name' => 't1.number', 'direction' => 'ASC');
                        break;
                    case 'number_desc':
                        $sort = array('col_name' => 't1.number', 'direction' => 'DESC');
                        break;
                    case 'group_name_asc':
                        $sort = array('col_name' => 'GM.group_name', 'direction' => 'ASC');
                        break;
                    case 'group_name_desc':
                        $sort = array('col_name' => 'GM.group_name', 'direction' => 'DESC');
                        break;
                    case 'rider_name_asc':
                        $sort = array('col_name' => 't1.rider_name', 'direction' => 'ASC');
                        break;
                    case 'rider_name_desc':
                        $sort = array('col_name' => 't1.rider_name', 'direction' => 'DESC');
                        break;
                    default:
                        $sort = array();
                        break;
                }
            } else {
                $sort = array();
            }

            if (!empty($_REQUEST['search_str'])) {
                $str = $_REQUEST['search_str'];
                $search['t1.rider_name'] = array("'%%' AND (t1.rider_name LIKE '%$str%' OR TM.team_name LIKE '%$str%' OR GM.group_name LIKE '%$str%' OR t1.number LIKE '%$str%') ", 'LIKE', 'null');
            } else {
                $search = array();
            }

            if (!empty($_REQUEST['filter']) && !empty($_REQUEST['group_filter'])) {
                $filter['t1.team_id'] = $_REQUEST['filter'];
                $filter['t1.group_id'] = $_REQUEST['group_filter'];
            } elseif (!empty($_REQUEST['filter'])) {
                $filter['t1.team_id'] = $_REQUEST['filter'];
            } elseif (!empty($_REQUEST['group_filter'])) {
                $filter['t1.group_id'] = $_REQUEST['group_filter'];
            } else {
                $filter = array();
            }

            $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
            $count = count($RiderModel->getAll(array_merge($opts, $sort, $search, $filter)));
            $row_count = 20;
            $pages = ceil($count / $row_count);
            $offset = ((int) $page - 1) * $row_count;

            $offset_arr = array('offset' => $offset, 'row_count' => $row_count);
            $arr = $RiderModel->getAll(array_merge($opts, $sort, $search, $filter, $offset_arr));

            $this->tpl['team_arr'] = $TeamModel->getAll();
            $this->tpl['group_arr'] = $GroupModel->getAll();
            $this->tpl['arr'] = $arr;
            $this->tpl['paginator'] = array('pages' => $pages);
        }
    }

    function delete() {
        $this->isAjax = true;
        if ($this->isXHR()) {
            if ($this->isLoged()) {
                if ($this->isAdmin() || $this->isUser()) {

                    Object::import('Model', 'Option');
                    $OptionModel = new OptionModel();
                    $option_arr = $OptionModel->getAll();

                    foreach ($option_arr as $key => $value) {
                        $this->tpl['option_arr'][$value['key']] = $value['value'];
                    }

                    if ($this->isXHR()) {
                        $this->isAjax = true;
                        $id = $_POST['id'];
                    } else {
                        $id = $_GET['id'];
                    }

                    if ($this->isDemo()) {
                        $this->index();
                        return;
                    }

                    Object:: import('Model', 'Rider');
                    $RiderModel = new RiderModel();
                    $arr = $RiderModel->get($id);
                    if (count($arr) == 0) {
                        if ($this->isXHR()) {
                            $this->index();
                            return;
                        } else {
                            Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminRiders&action=index");
                        }
                    }

                    if ($RiderModel->delete($id)) {
                        if ($this->isXHR()) {
                            $this->index();
                            return;
                        } else {
                            Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminRiders&action=index&err=5");
                        }
                    } else {
                        if ($this->isXHR()) {
                            $this->index();
                            return;
                        } else {
                            Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminRiders&action=index");
                        }
                    }
                } else {
                    $this->tpl['status'] = 2;
                }
            } else {
                $this->tpl['status'] = 1;
            }
        }
    }

    function update() {
        $this->isAjax = true;
        if ($this->isXHR()) {

            Object::import('Model', 'Option');
            $OptionModel = new OptionModel();
            $option_arr = $OptionModel->getAll();

            foreach ($option_arr as $key => $value) {
                $this->tpl['option_arr'][$value['key']] = $value['value'];
            }

            Object::import('Model', array('Rider', 'Team', 'Group'));
            $RiderModel = new RiderModel();
            $TeamModel = new TeamModel();
            $GroupModel = new GroupModel();

            $opts = array();

            if ($this->isUser()) {
                $opts['t1.team_id'] = $this->getUserTeamId();
                $this->tpl['user_team'] = $TeamModel->get($this->getUserTeamId());
            }

            $opts['t1.id'] = array($_REQUEST['id'], '<>', 'null');

            $RiderModel->addJoin($RiderModel->joins, $TeamModel->getTable(), 'TM', array('TM.id' => 't1.team_id'), array('TM.team_name'));
            $RiderModel->addJoin($RiderModel->joins, $GroupModel->getTable(), 'GM', array('GM.id' => 't1.group_id'), array('GM.group_name'));
            if (!empty($_REQUEST['sort'])) {
                switch ($_REQUEST['sort']) {
                    case 'team_name_asc':
                        $sort = array('col_name' => 'TM.team_name', 'direction' => 'ASC');
                        break;
                    case 'team_name_desc':
                        $sort = array('col_name' => 'TM.team_name', 'direction' => 'DESC');
                        break;
                    case 'number_asc':
                        $sort = array('col_name' => 't1.number', 'direction' => 'ASC');
                        break;
                    case 'number_desc':
                        $sort = array('col_name' => 't1.number', 'direction' => 'DESC');
                        break;
                    case 'group_name_asc':
                        $sort = array('col_name' => 'GM.group_name', 'direction' => 'ASC');
                        break;
                    case 'group_name_desc':
                        $sort = array('col_name' => 'GM.group_name', 'direction' => 'DESC');
                        break;
                    case 'rider_name_asc':
                        $sort = array('col_name' => 't1.rider_name', 'direction' => 'ASC');
                        break;
                    case 'rider_name_desc':
                        $sort = array('col_name' => 't1.rider_name', 'direction' => 'DESC');
                        break;
                    default:
                        $sort = array();
                        break;
                }
            } else {
                $sort = array();
            }

            if (!empty($_REQUEST['search_str'])) {
                $str = $_REQUEST['search_str'];
                $search['t1.rider_name'] = array("'%%' AND (t1.rider_name LIKE '%$str%' OR TM.team_name LIKE '%$str%' OR GM.group_name LIKE '%$str%' OR t1.number LIKE '%$str%') ", 'LIKE', 'null');
            } else {
                $search = array();
            }

            if (!empty($_REQUEST['filter']) && !empty($_REQUEST['group_filter'])) {
                $filter['t1.team_id'] = $_REQUEST['filter'];
                $filter['t1.group_id'] = $_REQUEST['group_filter'];
            } elseif (!empty($_REQUEST['filter'])) {
                $filter['t1.team_id'] = $_REQUEST['filter'];
            } elseif (!empty($_REQUEST['group_filter'])) {
                $filter['t1.group_id'] = $_REQUEST['group_filter'];
            } else {
                $filter = array();
            }

            $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
            $count = count($RiderModel->getAll(array_merge($opts, $sort, $search, $filter)));
            $row_count = 20;
            $pages = ceil($count / $row_count);
            $offset = ((int) $page - 1) * $row_count;

            $offset_arr = array('offset' => $offset, 'row_count' => $row_count);
            $arr = $RiderModel->getAll(array_merge($opts, $sort, $search, $filter, $offset_arr));

            $this->tpl['team_arr'] = $TeamModel->getAll();
            $this->tpl['group_arr'] = $GroupModel->getAll();
            $this->tpl['rider'] = $RiderModel->get($_REQUEST['id']);
            $this->tpl['arr'] = $arr;
            $this->tpl['paginator'] = array('pages' => $pages);
        }
    }

    function edit() {
        $this->isAjax = true;

        if ($this->isXHR()) {
            Object::import('Model', 'Option');
            $OptionModel = new OptionModel();
            $option_arr = $OptionModel->getAll();

            foreach ($option_arr as $key => $value) {
                $this->tpl['option_arr'][$value['key']] = $value['value'];
            }
            Object::import('Model', array('Rider', 'Team', 'Group'));
            $TeamModel = new TeamModel();
            $RiderModel = new RiderModel();
            $GroupModel = new GroupModel();
            $data = array();

            if (!empty($_REQUEST['q_1']) && $_REQUEST['q_1'] == '1') {
                $data['q_1'] = '1';
            } else {
                $data['q_1'] = '0';
            }
            if (!empty($_REQUEST['q_2']) && $_REQUEST['q_2'] == '1') {
                $data['q_2'] = '1';
            } else {
                $data['q_2'] = '0';
            }
            if (!empty($_REQUEST['q_3']) && $_REQUEST['q_3'] == '1') {
                $data['q_3'] = '1';
            } else {
                $data['q_3'] = '0';
            }
            if (!empty($_REQUEST['f_sm']) && $_REQUEST['f_sm'] == '1') {
                $data['f_sm'] = '1';
            } else {
                $data['f_sm'] = '0';
            }
            if (!empty($_REQUEST['f_dm']) && $_REQUEST['f_dm'] == '1') {
                $data['f_dm'] = '1';
            } else {
                $data['f_dm'] = '0';
            }
            if ($this->isUser()) {
                $data['team_id'] = $this->getUserTeamId();
                $data['user_id'] = $this->getUserId();
            }
            if ((!empty($_REQUEST['team_id']) || !empty($data['team_id'])) && !empty($_REQUEST['number']) && !empty($_REQUEST['group_id']) && !empty($_REQUEST['rider_name'])) {
                $RiderModel->update(array_merge($_REQUEST, $data));
                $this->tpl['err'] = 3;
            } else {
                $this->tpl['err'] = 4;
                $opts = array();

                if ($this->isUser()) {
                    $opts['t1.team_id'] = $this->getUserTeamId();
                    $this->tpl['user_team'] = $TeamModel->get($this->getUserTeamId());
                }

                $RiderModel->addJoin($RiderModel->joins, $TeamModel->getTable(), 'TM', array('TM.id' => 't1.team_id'), array('TM.team_name'));
                $RiderModel->addJoin($RiderModel->joins, $GroupModel->getTable(), 'GM', array('GM.id' => 't1.group_id'), array('GM.group_name'));
                if (!empty($_REQUEST['sort'])) {
                    switch ($_REQUEST['sort']) {
                        case 'team_name_asc':
                            $sort = array('col_name' => 'TM.team_name', 'direction' => 'ASC');
                            break;
                        case 'team_name_desc':
                            $sort = array('col_name' => 'TM.team_name', 'direction' => 'DESC');
                            break;
                        case 'number_asc':
                            $sort = array('col_name' => 't1.number', 'direction' => 'ASC');
                            break;
                        case 'number_desc':
                            $sort = array('col_name' => 't1.number', 'direction' => 'DESC');
                            break;
                        case 'group_name_asc':
                            $sort = array('col_name' => 'GM.group_name', 'direction' => 'ASC');
                            break;
                        case 'group_name_desc':
                            $sort = array('col_name' => 'GM.group_name', 'direction' => 'DESC');
                            break;
                        case 'rider_name_asc':
                            $sort = array('col_name' => 't1.rider_name', 'direction' => 'ASC');
                            break;
                        case 'rider_name_desc':
                            $sort = array('col_name' => 't1.rider_name', 'direction' => 'DESC');
                            break;
                        default:
                            $sort = array();
                            break;
                    }
                } else {
                    $sort = array();
                }

                if (!empty($_REQUEST['search_str'])) {
                    $str = $_REQUEST['search_str'];
                    $search['t1.rider_name'] = array("'%%' AND (t1.rider_name LIKE '%$str%' OR TM.team_name LIKE '%$str%' OR GM.group_name LIKE '%$str%' OR t1.number LIKE '%$str%') ", 'LIKE', 'null');
                } else {
                    $search = array();
                }

                if (!empty($_REQUEST['filter']) && !empty($_REQUEST['group_filter'])) {
                    $filter['t1.team_id'] = $_REQUEST['filter'];
                    $filter['t1.group_id'] = $_REQUEST['group_filter'];
                } elseif (!empty($_REQUEST['filter'])) {
                    $filter['t1.team_id'] = $_REQUEST['filter'];
                } elseif (!empty($_REQUEST['group_filter'])) {
                    $filter['t1.group_id'] = $_REQUEST['group_filter'];
                } else {
                    $filter = array();
                }

                $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
                $count = count($RiderModel->getAll(array_merge($opts, $sort, $search, $filter)));
                $row_count = 20;
                $pages = ceil($count / $row_count);
                $offset = ((int) $page - 1) * $row_count;

                $offset_arr = array('offset' => $offset, 'row_count' => $row_count);
                $arr = $RiderModel->getAll(array_merge($opts, $sort, $search, $filter, $offset_arr));

                $this->tpl['team_arr'] = $TeamModel->getAll();
                $this->tpl['group_arr'] = $GroupModel->getAll();
                $this->tpl['arr'] = $arr;
                $this->tpl['paginator'] = array('pages' => $pages);

                $this->index();

                return;
            }

            $opts = array();

            if ($this->isUser()) {
                $opts['t1.team_id'] = $this->getUserTeamId();
                $this->tpl['user_team'] = $TeamModel->get($this->getUserTeamId());
            }

            $RiderModel->addJoin($RiderModel->joins, $TeamModel->getTable(), 'TM', array('TM.id' => 't1.team_id'), array('TM.team_name'));
            $RiderModel->addJoin($RiderModel->joins, $GroupModel->getTable(), 'GM', array('GM.id' => 't1.group_id'), array('GM.group_name'));
            if (!empty($_REQUEST['sort'])) {
                switch ($_REQUEST['sort']) {
                    case 'team_name_asc':
                        $sort = array('col_name' => 'TM.team_name', 'direction' => 'ASC');
                        break;
                    case 'team_name_desc':
                        $sort = array('col_name' => 'TM.team_name', 'direction' => 'DESC');
                        break;
                    case 'number_asc':
                        $sort = array('col_name' => 't1.number', 'direction' => 'ASC');
                        break;
                    case 'number_desc':
                        $sort = array('col_name' => 't1.number', 'direction' => 'DESC');
                        break;
                    case 'group_name_asc':
                        $sort = array('col_name' => 'GM.group_name', 'direction' => 'ASC');
                        break;
                    case 'group_name_desc':
                        $sort = array('col_name' => 'GM.group_name', 'direction' => 'DESC');
                        break;
                    case 'rider_name_asc':
                        $sort = array('col_name' => 't1.rider_name', 'direction' => 'ASC');
                        break;
                    case 'rider_name_desc':
                        $sort = array('col_name' => 't1.rider_name', 'direction' => 'DESC');
                        break;
                    default:
                        $sort = array();
                        break;
                }
            } else {
                $sort = array();
            }

            if (!empty($_REQUEST['search_str'])) {
                $str = $_REQUEST['search_str'];
                $search['t1.rider_name'] = array("'%%' AND (t1.rider_name LIKE '%$str%' OR TM.team_name LIKE '%$str%' OR GM.group_name LIKE '%$str%' OR t1.number LIKE '%$str%') ", 'LIKE', 'null');
            } else {
                $search = array();
            }

            if (!empty($_REQUEST['filter']) && !empty($_REQUEST['group_filter'])) {
                $filter['t1.team_id'] = $_REQUEST['filter'];
                $filter['t1.group_id'] = $_REQUEST['group_filter'];
            } elseif (!empty($_REQUEST['filter'])) {
                $filter['t1.team_id'] = $_REQUEST['filter'];
            } elseif (!empty($_REQUEST['group_filter'])) {
                $filter['t1.group_id'] = $_REQUEST['group_filter'];
            } else {
                $filter = array();
            }

            $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
            $count = count($RiderModel->getAll(array_merge($opts, $sort, $search, $filter)));
            $row_count = 20;
            $pages = ceil($count / $row_count);
            $offset = ((int) $page - 1) * $row_count;

            $offset_arr = array('offset' => $offset, 'row_count' => $row_count);
            $arr = $RiderModel->getAll(array_merge($opts, $sort, $search, $filter, $offset_arr));

            $this->tpl['team_arr'] = $TeamModel->getAll();
            $this->tpl['group_arr'] = $GroupModel->getAll();
            $this->tpl['arr'] = $arr;
            $this->tpl['paginator'] = array('pages' => $pages);
        }
    }

    function search() {
        $this->isAjax = true;

        if ($this->isXHR()) {
            if ($this->isLoged()) {
                Object::import('Model', 'Option');
                $OptionModel = new OptionModel();
                $option_arr = $OptionModel->getAll();

                foreach ($option_arr as $key => $value) {
                    $this->tpl['option_arr'][$value['key']] = $value['value'];
                }
                Object::import('Model', array('Rider', 'Team', 'Group'));
                $RiderModel = new RiderModel();
                $TeamModel = new TeamModel();
                $GroupModel = new GroupModel();

                $opts = array();

                if ($this->isUser()) {
                    // $opts['t1.team_id'] = $this->getUserTeamId();
                    $this->tpl['user_team'] = $TeamModel->get($this->getUserTeamId());
                }

                $RiderModel->addJoin($RiderModel->joins, $TeamModel->getTable(), 'TM', array('TM.id' => 't1.team_id'), array('TM.team_name'));
                $RiderModel->addJoin($RiderModel->joins, $GroupModel->getTable(), 'GM', array('GM.id' => 't1.group_id'), array('GM.group_name'));

                if (!empty($_REQUEST['sort'])) {
                    switch ($_REQUEST['sort']) {
                        case 'team_name_asc':
                            $sort = array('col_name' => 'TM.team_name', 'direction' => 'ASC');
                            break;
                        case 'team_name_desc':
                            $sort = array('col_name' => 'TM.team_name', 'direction' => 'DESC');
                            break;
                        case 'number_asc':
                            $sort = array('col_name' => 't1.number', 'direction' => 'ASC');
                            break;
                        case 'number_desc':
                            $sort = array('col_name' => 't1.number', 'direction' => 'DESC');
                            break;
                        case 'group_name_asc':
                            $sort = array('col_name' => 'GM.group_name', 'direction' => 'ASC');
                            break;
                        case 'group_name_desc':
                            $sort = array('col_name' => 'GM.group_name', 'direction' => 'DESC');
                            break;
                        case 'rider_name_asc':
                            $sort = array('col_name' => 't1.rider_name', 'direction' => 'ASC');
                            break;
                        case 'rider_name_desc':
                            $sort = array('col_name' => 't1.rider_name', 'direction' => 'DESC');
                            break;
                        default:
                            $sort = array();
                            break;
                    }
                } else {
                    $sort = array();
                }

                if (!empty($_REQUEST['search_str'])) {
                    $str = $_REQUEST['search_str'];
                    $search['t1.rider_name'] = array("'%%' AND (t1.rider_name LIKE '%$str%' OR TM.team_name LIKE '%$str%' OR GM.group_name LIKE '%$str%' OR t1.number LIKE '%$str%') ", 'LIKE', 'null');
                } else {
                    $search = array();
                }

                if (!empty($_REQUEST['filter']) && !empty($_REQUEST['group_filter'])) {
                    $filter['t1.team_id'] = $_REQUEST['filter'];
                    $filter['t1.group_id'] = $_REQUEST['group_filter'];
                } elseif (!empty($_REQUEST['filter'])) {
                    $filter['t1.team_id'] = $_REQUEST['filter'];
                } elseif (!empty($_REQUEST['group_filter'])) {
                    $filter['t1.group_id'] = $_REQUEST['group_filter'];
                } else {
                    $filter = array();
                }

                $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
                $count = count($RiderModel->getAll(array_merge($opts, $sort, $search, $filter)));
                $row_count = 20;
                $pages = ceil($count / $row_count);
                $offset = ((int) $page - 1) * $row_count;

                $offset_arr = array('offset' => $offset, 'row_count' => $row_count);
                $arr = $RiderModel->getAll(array_merge($opts, $sort, $search, $filter, $offset_arr));

                $this->tpl['team_arr'] = $TeamModel->getAll();
                $this->tpl['group_arr'] = $GroupModel->getAll();
                $this->tpl['arr'] = $arr;
                $this->tpl['paginator'] = array('pages' => $pages);

                $this->js[] = array('file' => 'adminRider.js', 'path' => JS_PATH);
            } else {
                $this->tpl['status'] = 1;
            }
        }
    }

    function serach_riders() {
        $this->isAjax = true;

        if ($this->isXHR()) {
            if ($this->isLoged()) {
                Object::import('Model', 'Option');
                $OptionModel = new OptionModel();
                $option_arr = $OptionModel->getAll();

                foreach ($option_arr as $key => $value) {
                    $this->tpl['option_arr'][$value['key']] = $value['value'];
                }
                Object::import('Model', array('Rider', 'Team', 'Group'));
                $RiderModel = new RiderModel();
                $TeamModel = new TeamModel();
                $GroupModel = new GroupModel();

                $this->tpl['team_arr'] = $TeamModel->getAll();
                $this->tpl['group_arr'] = $GroupModel->getAll();

                $opts = array();

                if ($this->isUser()) {
                    $opts['t1.team_id'] = $this->getUserTeamId();
                    $this->tpl['user_team'] = $TeamModel->get($this->getUserTeamId());
                }

                $RiderModel->addJoin($RiderModel->joins, $TeamModel->getTable(), 'TM', array('TM.id' => 't1.team_id'), array('TM.team_name'));
                $RiderModel->addJoin($RiderModel->joins, $GroupModel->getTable(), 'GM', array('GM.id' => 't1.group_id'), array('GM.group_name'));

                if (!empty($_REQUEST['sort'])) {
                    switch ($_REQUEST['sort']) {
                        case 'team_name_asc':
                            $sort = array('col_name' => 'TM.team_name', 'direction' => 'ASC');
                            break;
                        case 'team_name_desc':
                            $sort = array('col_name' => 'TM.team_name', 'direction' => 'DESC');
                            break;
                        case 'number_asc':
                            $sort = array('col_name' => 't1.number', 'direction' => 'ASC');
                            break;
                        case 'number_desc':
                            $sort = array('col_name' => 't1.number', 'direction' => 'DESC');
                            break;
                        case 'group_name_asc':
                            $sort = array('col_name' => 'GM.group_name', 'direction' => 'ASC');
                            break;
                        case 'group_name_desc':
                            $sort = array('col_name' => 'GM.group_name', 'direction' => 'DESC');
                            break;
                        case 'rider_name_asc':
                            $sort = array('col_name' => 't1.rider_name', 'direction' => 'ASC');
                            break;
                        case 'rider_name_desc':
                            $sort = array('col_name' => 't1.rider_name', 'direction' => 'DESC');
                            break;
                        default:
                            $sort = array();
                            break;
                    }
                } else {
                    $sort = array();
                }

                if (!empty($_REQUEST['search_str'])) {
                    $str = $_REQUEST['search_str'];
                    $search['t1.rider_name'] = array("'%%' AND (t1.rider_name LIKE '%$str%' OR TM.team_name LIKE '%$str%' OR GM.group_name LIKE '%$str%' OR t1.number LIKE '%$str%') ", 'LIKE', 'null');
                } else {
                    $search = array();
                }

                if (!empty($_REQUEST['filter']) && !empty($_REQUEST['group_filter'])) {
                    $filter['t1.team_id'] = $_REQUEST['filter'];
                    $filter['t1.group_id'] = $_REQUEST['group_filter'];
                } elseif (!empty($_REQUEST['filter'])) {
                    $filter['t1.team_id'] = $_REQUEST['filter'];
                } elseif (!empty($_REQUEST['group_filter'])) {
                    $filter['t1.group_id'] = $_REQUEST['group_filter'];
                } else {
                    $filter = array();
                }

                $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
                $count = count($RiderModel->getAll(array_merge($opts, $sort, $search, $filter)));
                $row_count = 20;
                $pages = ceil($count / $row_count);
                $offset = ((int) $page - 1) * $row_count;

                $offset_arr = array('offset' => $offset, 'row_count' => $row_count);
                $arr = $RiderModel->getAll(array_merge($opts, $sort, $search, $filter, $offset_arr));

                $this->tpl['team_arr'] = $TeamModel->getAll();
                $this->tpl['arr'] = $arr;
                $this->tpl['paginator'] = array('pages' => $pages);

                $this->js[] = array('file' => 'adminRider.js', 'path' => JS_PATH);
            } else {
                $this->tpl['status'] = 1;
            }
        }
    }

}

?>