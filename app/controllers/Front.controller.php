<?php

require_once CONTROLLERS_PATH . 'AppController.controller.php';

/**
 * Front controller
 *
 * @package cms
 * @subpackage cms.app.controllers
 */
class Front extends AppController {

    /**
     * Define layout used by controller
     *
     * @access public
     * @var string
     */
    var $layout = 'front';

    /**
     * Constructor
     */
    function Front() {
        ob_start();
    }

    /**
     * (non-PHPdoc)
     * @see core/framework/Controller::beforeFilter()
     * @access public
     * @return void
     */
    function beforeFilter() {
        if (isset($_GET['layout'])) {
            $this->layout = 'empty';
        }
    }

    /**
     * (non-PHPdoc)
     * @see core/framework/Controller::beforeRender()
     * @access public
     */
    function beforeRender() {
        
    }

    /**
     * (non-PHPdoc)
     * @see core/framework/Controller::index()
     */
    function index() {
        
    }

    /**
     * Init calendar
     *
     * @access public
     * @return void
     */
    function load() {
        return;
    }

    function jsSection() {
        $this->isAjax = true;
        if ($this->isXHR()) {
            Object::import('Model', array('Section'));
            $SectionModel = new SectionModel();
            $section_id = $_GET['id'];

            $section_arr = $SectionModel->get($section_id);

            $this->tpl['section_content'] = $section_arr['section_content'];
        }
    }

    function phpSection() {

        Object::import('Model', array('Section'));
        $SectionModel = new SectionModel();
        $section_id = $_GET['id'];

        $section_arr = $SectionModel->get($section_id);

        $this->tpl['section_content'] = $section_arr['section_content'];
    }

    function jsRiders() {
        $this->isAjax = true;

        if ($this->isXHR()) {
            Object::import('Model', array('Rider', 'Team', 'Group'));
            $RiderModel = new RiderModel();
            $TeamModel = new TeamModel();
            $GroupModel = new GroupModel();

            $opts = array();

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

            Object::import('Model', 'Option');
            $OptionModel = new OptionModel();
            $option_arr = $OptionModel->getAll();
            
            foreach($option_arr as $key => $value){
                $this->tpl['option_arr'][$value['key']] = $value['value'];
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

}