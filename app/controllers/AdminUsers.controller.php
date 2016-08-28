<?php

require_once CONTROLLERS_PATH . 'Admin.controller.php';

/**
 * AdminUsers controller
 *
 * @package cms
 * @subpackage cms.app.controllers
 */
class AdminUsers extends Admin {

    /**
     * Create user
     *
     * @access public
     * @return void
     */
    function create() {
        if ($this->isLoged()) {
            if ($this->isAdmin()) {
                $err = NULL;
                if (isset($_POST['user_create'])) {
                    if ($this->isDemo()) {
                        $err = 7;
                    } else {

                        Object::import('Model', array('User'));
                        $UserModel = new UserModel();

                        $_POST['password'] = md5($_POST['password']);

                        $id = $UserModel->save($_POST);
                        if ($id !== false && (int) $id > 0) {
                            $err = 1;
                        } else {
                            $err = 2;
                        }
                    }
                }
                Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=index&err=$err");
            } else {
                $this->tpl['status'] = 2;
            }
        } else {
            $this->tpl['status'] = 1;
        }
    }

    /**
     * Delete user, support AJAX too
     *
     * @access public
     * @return void
     */
    function delete() {
        if ($this->isLoged()) {
            if ($this->isAdmin()) {
                if (!$this->isMultiUser()) {
                    $this->tpl['status'] = 9;
                    return;
                }

                if ($this->isXHR()) {
                    $this->isAjax = true;
                    $id = $_POST['id'];
                } else {
                    $id = $_GET['id'];
                }

                if ($this->isDemo()) {
                    $_GET['err'] = 7;
                    $this->index();
                    return;
                }

                Object::import('Model', 'User');
                $UserModel = new UserModel();

                $arr = $UserModel->get($id);
                if (count($arr) == 0) {
                    if ($this->isXHR()) {
                        $_GET['err'] = 1;
                        $this->index();
                        return;
                    } else {
                        Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=index&err=8");
                    }
                }

                if ($UserModel->delete($id)) {
                    $this->index();
                    return;
                } else {
                    if ($this->isXHR()) {
                        $_GET['err'] = 4;
                        $this->index();
                        return;
                    } else {
                        Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=index&err=4");
                    }
                }
            } else {
                $this->tpl['status'] = 2;
            }
        } else {
            $this->tpl['status'] = 1;
        }
    }

    /**
     * List of users
     *
     * (non-PHPdoc)
     * @see app/controllers/Admin::index()
     * @access public
     * @return void
     */
    function index() {
        if ($this->isLoged()) {
          //  if ($this->isAdmin()) {
                if (!$this->isMultiUser()) {
                    $this->tpl['status'] = 9;
                    return;
                }

                Object::import('Model', array('User', 'Role', 'Team'));
                $UserModel = new UserModel();
                $RoleModel = new RoleModel();
                $TeamModel = new TeamModel();

                $opts = array();

                $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
                $count = $UserModel->getCount($opts);
                $row_count = 20;
                $pages = ceil($count / $row_count);
                $offset = ((int) $page - 1) * $row_count;

                $UserModel->addJoin($UserModel->joins, $RoleModel->getTable(), 'TR', array('TR.id' => 't1.role_id'), array('TR.role'));
                $UserModel->addJoin($UserModel->joins, $TeamModel->getTable(), 'TM', array('TM.id' => 't1.team_id'), array('TM.team_name'));
                $arr = $UserModel->getAll($opts);

                $this->tpl['arr'] = $arr;
                $this->tpl['paginator'] = array('pages' => $pages);
                $this->tpl['role_arr'] = $RoleModel->getAll();
                $this->tpl['team_arr'] = $TeamModel->getAll(array('col_name' => 't1.team_name', 'direction' => 'ASC'));

                $this->js[] = array('file' => 'jquery.ui.button.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');
                $this->js[] = array('file' => 'jquery.ui.position.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');
                $this->js[] = array('file' => 'jquery.ui.dialog.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');

                $this->css[] = array('file' => 'jquery.ui.button.css', 'path' => LIBS_PATH . 'jquery/ui/css/smoothness/');
                $this->css[] = array('file' => 'jquery.ui.dialog.css', 'path' => LIBS_PATH . 'jquery/ui/css/smoothness/');

                $this->js[] = array('file' => 'jquery.validate.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
                $this->js[] = array('file' => 'jquery.multiselect.min.js', 'path' => LIBS_PATH . 'jquery/');
                $this->js[] = array('file' => 'adminUsers.js', 'path' => JS_PATH);
          /*  } else {
                $this->tpl['status'] = 2;
            }*/
        } else {
            $this->tpl['status'] = 1;
        }
    }

    /**
     * Set user 'status'
     *
     * @access public
     * @return void
     */
    function set() {
        $this->isAjax = true;

        if ($this->isXHR()) {
            if ($this->isDemo()) {
                $_GET['err'] = 7;
                $this->index();
                return;
            }

            Object::import('Model', 'User');
            $UserModel = new UserModel();

            $arr = $UserModel->get($_POST['id']);

            if (count($arr) > 0) {
                switch ($arr['status']) {
                    case 'T':
                        $sql_status = 'F';
                        break;
                    case 'F':
                        $sql_status = 'T';
                        break;
                    default:
                        return;
                }
                $UserModel->update(array('id' => $_POST['id'], 'status' => $sql_status));
            }
        }
        $this->index();
    }

    /**
     * Update user
     *
     * @param int $id
     * @access public
     * @return void
     */
    function update($id = null) {
        if ($this->isLoged()) {
            if ($this->isAdmin()) {
                if (!$this->isMultiUser()) {
                    $this->tpl['status'] = 9;
                    return;
                }

                Object::import('Model', array('User', 'Team'));
                $UserModel = new UserModel();
                $TeamModel = new TeamModel();

                if (isset($_POST['user_update'])) {
                    if ($this->isDemo()) {
                        Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=index&err=7");
                    }

                    $data = array();
                    $entered_password = null;
                    if (!empty($_POST['password']) && $_POST['password'] != 'password') {
                        $entered_password = $_POST['password'];
                        $_POST['password'] = md5($_POST['password']);
                    } else {
                        unset($_POST['password']);
                    }

                    $opts = array();
                    $opts['email'] = $_POST['email'];
                    $opts['id'] = array($_POST['id'], '<>', 'null');

                    $arr = $UserModel->getAll($opts);

                    if (count($arr) > 0) {
                        Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=index&err=6");
                    } else {
                        if ($UserModel->update(array_merge($_POST, $data))) {
                            if (isset($entered_password) && $_SESSION[$this->default_user]['id'] == $_POST['id']) {
                                $_SESSION[$this->default_user]['password'] = $entered_password;
                            }
                        }
                    }
                    Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=index&err=5");
                } else {
                    $arr = $UserModel->get($id);
                    if (count($arr) === 0) {
                        Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=index&err=8");
                    }
                    $this->tpl['arr'] = $arr;

                    Object::import('Model', 'Role');
                    $RoleModel = new RoleModel();
                    $this->tpl['role_arr'] = $RoleModel->getAll();

                    $this->tpl['team_arr'] = $TeamModel->getAll(array('col_name' => 't1.team_name', 'direction' => 'ASC'));
                }
                $this->js[] = array('file' => 'jquery.validate.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
                $this->js[] = array('file' => 'jquery.multiselect.min.js', 'path' => LIBS_PATH . 'jquery/');
                $this->js[] = array('file' => 'adminUsers.js', 'path' => JS_PATH);
            } else {
                $this->tpl['status'] = 2;
            }
        } else {
            $this->tpl['status'] = 1;
        }
    }

    /**
     * Update user profile is used by Editor
     *
     * @param int $id
     * @access public
     * @return void
     */
    function profile() {
        if ($this->isLoged()) {
            if ($this->isAdmin() || $this->isUser()) {

                Object::import('Model', array('User', 'Team'));
                $UserModel = new UserModel();
                $TeamModel = new TeamModel();
                if (isset($_POST['update_profile'])) {
                    if ($this->isDemo()) {
                        Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=index&err=7");
                    }

                    $data = array();
                    $entered_password = null;
                    if (!empty($_POST['password']) && $_POST['password'] != 'password') {
                        $entered_password = $_POST['password'];
                        $_POST['password'] = md5($_POST['password']);
                    } else {
                        unset($_POST['password']);
                    }
                    $opts = array();
                    $opts['email'] = $_POST['email'];
                    $opts['id'] = array($_POST['id'], '<>', 'null');

                    $arr = $UserModel->getAll($opts);

                    if (count($arr) > 0) {
                        Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminUsers&action=profile&err=6");
                    } else {
                        if ($UserModel->update(array_merge($_POST, $data))) {
                            if (isset($entered_password) && $_SESSION[$this->default_user]['id'] == $_POST['id']) {
                                $_SESSION[$this->default_user]['password'] = $entered_password;
                            }
                        }
                    }
                    $_GET['err'] = 5;
                }
                $UserModel->addJoin($UserModel->joins, $TeamModel->getTable(), 'TM', array('TM.id' => 't1.team_id'), array('TM.team_name'));
                $arr = $UserModel->getAll(array('t1.id' => $_SESSION[$this->default_user]['id']));
                $this->tpl['arr'] = $arr[0];

                $this->js[] = array('file' => 'jquery.validate.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
                $this->js[] = array('file' => 'adminUsers.js', 'path' => JS_PATH);
            } else {
                $this->tpl['status'] = 2;
            }
        } else {
            $this->tpl['status'] = 1;
        }
    }

}