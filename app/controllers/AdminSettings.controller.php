<?php

require_once CONTROLLERS_PATH . 'Admin.controller.php';

class AdminSettings extends Admin {

    function index() {
        if ($this->isLoged()) {

            Object::import('Model', array('Team', 'Group'));
            $TeamModel = new TeamModel();
            $GroupModel = new GroupModel();
            $opts = array();

            $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
            $count = count($TeamModel->getAll($opts));
            $row_count = 20;
            $pages = ceil($count / $row_count);
            $offset = ((int) $page - 1) * $row_count;
            $offset_arr = array('offset' => $offset, 'row_count' => $row_count);
            $this->tpl['team_paginator'] = array('pages' => $pages);

            $this->tpl['team_arr'] = $TeamModel->getAll($offset_arr);

            $this->tpl['group_arr'] = $GroupModel->getAll();

            if (!empty($_GET['err'])) {
                $this->tpl['err'] = $_GET['err'];
            }
            
            $this->js[] = array('file' => 'jquery.ui.button.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');
            $this->js[] = array('file' => 'jquery.ui.position.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');
            $this->js[] = array('file' => 'jquery.ui.dialog.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');

            $this->css[] = array('file' => 'jquery.ui.button.css', 'path' => LIBS_PATH . 'jquery/ui/css/smoothness/');
            $this->css[] = array('file' => 'jquery.ui.dialog.css', 'path' => LIBS_PATH . 'jquery/ui/css/smoothness/');

            $this->js[] = array('file' => 'jquery.validate.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
            $this->js[] = array('file' => 'jquery.multiselect.min.js', 'path' => LIBS_PATH . 'jquery/');

            $this->js[] = array('file' => 'adminSettings.js', 'path' => JS_PATH);
        } else {
            $this->tpl['status'] = 1;
        }
    }

    function updateTeam() {
        $this->isAjax = true;

        if ($this->isXHR()) {
            Object::import('Model', array('Team', 'Group'));
            $TeamModel = new TeamModel();
            $GroupModel = new GroupModel();

            $opts = array();


            $opts['id'] = array($_REQUEST['id'], '<>', null);

            $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
            $count = count($TeamModel->getAll($opts));
            $row_count = 20;
            $pages = ceil($count / $row_count);
            $offset = ((int) $page - 1) * $row_count;
            $offset_arr = array('offset' => $offset, 'row_count' => $row_count);
            $this->tpl['team_paginator'] = array('pages' => $pages);

            $this->tpl['team_arr'] = $TeamModel->getAll(array_merge($offset_arr, $opts));
            $this->tpl['group_arr'] = $GroupModel->getAll();

            $this->tpl['team'] = $TeamModel->get($_REQUEST['id']);
        }
    }

    function updateGroup() {
        $this->isAjax = true;

        if ($this->isXHR()) {
            Object::import('Model', array('Team', 'Group'));
            $TeamModel = new TeamModel();
            $GroupModel = new GroupModel();

            $opts = array();
            $opts['id'] = array($_REQUEST['id'], '<>', null);
            $this->tpl['team_arr'] = $TeamModel->getAll();
            $this->tpl['group_arr'] = $GroupModel->getAll($opts);

            $this->tpl['group'] = $GroupModel->get($_REQUEST['id']);
        }
    }

    function editTeam() {
        $this->isAjax = true;

        if ($this->isXHR()) {
            Object::import('Model', array('Team', 'Group'));
            $TeamModel = new TeamModel();
            $GroupModel = new GroupModel();
            $opts = array();
            if (!empty($_REQUEST['team_name']) && !empty($_REQUEST['number_from']) && !empty($_REQUEST['number_to'])) {
                $TeamModel->update($_REQUEST);
                $this->tpl['err'] = '3';
            } else {
                $this->tpl['err'] = '4';
            }
            $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
            $count = count($TeamModel->getAll($opts));
            $row_count = 20;
            $pages = ceil($count / $row_count);
            $offset = ((int) $page - 1) * $row_count;
            $offset_arr = array('offset' => $offset, 'row_count' => $row_count);
            $this->tpl['team_paginator'] = array('pages' => $pages);

            $this->tpl['team_arr'] = $TeamModel->getAll($offset_arr);
            $this->tpl['group_arr'] = $GroupModel->getAll();
        }
    }

    function editGroup() {
        $this->isAjax = true;

        if ($this->isXHR()) {
            Object::import('Model', array('Team', 'Group'));
            $TeamModel = new TeamModel();
            $GroupModel = new GroupModel();
            if (!empty($_REQUEST['group_name'])) {
                $GroupModel->update($_REQUEST);
                $this->tpl['err'] = '8';
            } else {
                $this->tpl['err'] = '9';
            }
            $this->tpl['team_arr'] = $TeamModel->getAll();
            $this->tpl['group_arr'] = $GroupModel->getAll();
        }
    }

    function addTeam() {
        $this->isAjax = true;

        if ($this->isXHR()) {
            Object:: import('Model', array('Team', 'Group'));
            $TeamModel = new TeamModel();
            $GroupModel = new GroupModel();
            $opts = array();
            if (!empty($_REQUEST['team_name']) || !empty($_REQUEST['number_from']) || !empty($_REQUEST['number_to'])) {
                $TeamModel->save($_REQUEST);
                $this->tpl['err'] = '1';
            } else {
                $this->tpl['err'] = '2';
            }

            $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
            $count = count($TeamModel->getAll($opts));
            $row_count = 20;
            $pages = ceil($count / $row_count);
            $offset = ((int) $page - 1) * $row_count;
            $offset_arr = array('offset' => $offset, 'row_count' => $row_count);
            $this->tpl['team_paginator'] = array('pages' => $pages);

            $this->tpl['team_arr'] = $TeamModel->getAll($offset_arr);
            $this->tpl['group_arr'] = $GroupModel->getAll();
        }
    }

    function addGroup() {
        $this->isAjax = true;

        if ($this->isXHR()) {
            Object:: import('Model', array('Team', 'Group'));
            $TeamModel = new TeamModel();
            $GroupModel = new GroupModel();

            if (!empty($_REQUEST['group_name'])) {
                $GroupModel->save($_REQUEST);
                $this->tpl['err'] = '6';
            } else {
                $this->tpl['err'] = '7';
            }
            $opts = array();
            $page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
            $count = count($TeamModel->getAll($opts));
            $row_count = 20;
            $pages = ceil($count / $row_count);
            $offset = ((int) $page - 1) * $row_count;
            $offset_arr = array('offset' => $offset, 'row_count' => $row_count);
            $this->tpl['team_paginator'] = array('pages' => $pages);

            $this->tpl['team_arr'] = $TeamModel->getAll($offset_arr);
            $this->tpl['group_arr'] = $GroupModel->getAll();
        }
    }

    function deleteTeam() {
        if ($this->isLoged()) {
            if ($this->isAdmin()) {

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

                Object:: import('Model', 'Team');
                $TeamModel = new TeamModel();

                $arr = $TeamModel->get($id);
                if (count($arr) == 0) {
                    if ($this->isXHR()) {
                        $this->index();
                        return;
                    } else {
                        Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminSettings&action=index");
                    }
                }

                if ($TeamModel->delete($id)) {
                    if ($this->isXHR()) {
                        $_GET['err'] = 5;
                        $this->index();

                        return;
                    } else {
                        Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminSettings&action=index&err=5");
                    }
                } else {
                    if ($this->isXHR()) {

                        $this->index();

                        return;
                    } else {
                        Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminSettings&action=index");
                    }
                }
            } else {
                $this->tpl['status'] = 2;
            }
        } else {
            $this->tpl['status'] = 1;
        }
    }

    function deleteGroup() {
        if ($this->isLoged()) {
            if ($this->isAdmin()) {

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
                Object:: import('Model', 'Group');
                $GroupModel = new GroupModel();

                $arr = $GroupModel->get($id);
                if (count($arr) == 0) {
                    if ($this->isXHR()) {
                        $this->index();
                        return;
                    } else {
                        Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminSettings&action=index");
                    }
                }
                if ($GroupModel->delete($id)) {
                    if ($this->isXHR()) {
                        $_GET['err'] = 10;
                        $this->index();
                        return;
                    } else {
                        Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminSettings&action=index&err=3");
                    }
                } else {
                    if ($this->isXHR()) {
                        $this->index();
                        return;
                    } else {
                        Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminSettings&action=index&err=4");
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

?>
