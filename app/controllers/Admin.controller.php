<?php

require_once CONTROLLERS_PATH . 'AppController.controller.php';

/**
 * Admin controller
 *
 * @package tsbc
 * @subpackage tsbc.app.controllers
 */
class Admin extends AppController {

    /**
     * Hold name of current layout
     *
     * @access public
     * @var string
     */
    var $layout = 'admin';

    /**
     * Hold the name of session variable which store all the login information
     *
     * @access public
     * @var string
     * @example $_SESSION[$this->default_user] = 'test';
     */
    var $default_user = 'admin_user';

    /**
     * Hold the name of session variable which store selected language iso, e.g. 'en'
     *
     * @access public
     * @var string
     * @example $_SESSION[$this->default_product][$this->default_language] = 'test';
     */
    var $default_language = 'admin_language';

    /**
     * Whether to requre login or not
     *
     * @access private
     * @var bool
     */
    var $require_login = true;

    /**
     * Constructor
     *
     * @param bool $require_login
     */
    function Admin($require_login = null) {
        if (!is_null($require_login) && is_bool($require_login)) {
            $this->require_login = $require_login;
        }

        if ($this->require_login) {
            if (!$this->isLoged() && @$_GET['action'] != 'login') {
                Util::redirect($_SERVER['PHP_SELF'] . "?controller=Admin&action=login");
            }
        }
    }

    /**
     * (non-PHPdoc)
     * @see core/framework/Controller::afterFilter()
     */
    function afterFilter() {
        
    }

    /**
     * (non-PHPdoc)
     * @see core/framework/Controller::beforeFilter()
     */
    function beforeFilter() {
        $this->js[] = array('file' => 'jquery-1.8.1.min.js', 'path' => LIBS_PATH . 'jquery/');
        $this->js[] = array('file' => 'admin-core.js', 'path' => JS_PATH);

        $this->js[] = array('file' => 'jquery.ui.core.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');
        $this->js[] = array('file' => 'jquery.ui.widget.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');
        $this->js[] = array('file' => 'jquery.ui.tabs.min.js', 'path' => LIBS_PATH . 'jquery/ui/js/');

        $this->css[] = array('file' => 'jquery.ui.core.css', 'path' => LIBS_PATH . 'jquery/ui/css/smoothness/');
        $this->css[] = array('file' => 'jquery.ui.theme.css', 'path' => LIBS_PATH . 'jquery/ui/css/smoothness/');
        $this->css[] = array('file' => 'jquery.ui.tabs.css', 'path' => LIBS_PATH . 'jquery/ui/css/smoothness/');

        $this->css[] = array('file' => 'admin.css', 'path' => CSS_PATH);
    }

    /**
     * (non-PHPdoc)
     * @see core/framework/Controller::beforeRender()
     */
    function beforeRender() {
        
    }

    /**
     * (non-PHPdoc)
     * @see core/framework/Controller::index()
     * @access public
     * @return void
     */
    function index() {
        if ($this->isLoged()) {
            if ($this->isAdmin()) {
                Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminRiders&action=index");
            } else {
                $this->tpl['status'] = 2;
            }
        } else {
            $this->tpl['status'] = 1;
        }
    }

    /**
     * Log in user
     *
     * @access public
     * @return void
     */
    function login() {
        $this->layout = 'admin_login';

        if (isset($_POST['login_user'])) {
            Object::import('Model', 'User');
            $UserModel = new UserModel();

            $opts['email'] = $_POST['login_email'];
            $opts['password'] = md5($_POST['login_password']);

            $user = $UserModel->getAll($opts);

            if (count($user) != 1) {
                # Login failed
                Util::redirect($_SERVER['PHP_SELF'] . "?controller=Admin&action=login&err=1");
            } else {
                $user = $user[0];
                #unset($user['password']);

                if (!in_array($user['role_id'], array(1, 2))) {
                    # Login denied
                    Util::redirect($_SERVER['PHP_SELF'] . "?controller=Admin&action=login&err=2");
                }

                if ($user['status'] != 'T') {
                    # Login forbidden
                    Util::redirect($_SERVER['PHP_SELF'] . "?controller=Admin&action=login&err=3");
                }

                Object::import('Model', 'Team');
                $TeamModel = new TeamModel();
                if (!empty($user['team_id'])) {
                    $arr = $TeamModel->get($user['team_id']);
                    if (!empty($arr['team_name'])) {
                        $user['team_name'] = $arr['team_name'];
                    }
                }

                # Login succeed
                $_SESSION[$this->default_user] = $user;


                # Update
                $data['id'] = $user['id'];
                $data['last_login'] = date("Y-m-d H:i:s");
                $UserModel->update($data);

                if ($this->isAdmin()) {
                    Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminRiders&action=index");
                }

                if ($this->isEditor()) {
                    Util::redirect($_SERVER['PHP_SELF'] . "?controller=AdminRiders&action=index");
                }
            }
        }
        $this->js[] = array('file' => 'jquery.validate.min.js', 'path' => LIBS_PATH . 'jquery/plugins/validate/js/');
        $this->js[] = array('file' => 'admin.js', 'path' => JS_PATH);
        return false;
    }

    /**
     * Log out user
     *
     * @access public
     * @return void
     */
    function logout() {
        if ($this->isLoged()) {
            unset($_SESSION[$this->default_user]);
            unset($_SESSION[$this->default_product]);
        }
        Util::redirect($_SERVER['PHP_SELF'] . "?controller=Admin&action=login");
    }

    /**
     * Change current locale
     *
     * @param string $iso
     * @access public
     * @return void
     */
    function local($iso) {
        if (in_array(strtolower($iso), array('en'))) {
            $_SESSION[$this->default_product][$this->default_language] = $iso;
        }

        Util::redirect($_SERVER['PHP_SELF'] . "?controller=Admin&action=index");
    }

    function version() {
        printf('BUILD: %s', SCRIPT_BUILD);
        exit;
    }

    function hash() {
        if ($this->isLoged()) {
            if ($this->isAdmin()) {
                @set_time_limit(0);

                if (!function_exists('md5_file')) {
                    die("Function <b>md5_file</b> doesn't exists");
                }

                # Origin hash -------------
                if (!is_file(CONFIG_PATH . 'files.check')) {
                    die("File <b>files.check</b> is missing");
                }
                $json = @file_get_contents(CONFIG_PATH . 'files.check');
                Object::import('Component', 'Services_JSON');
                $Services_JSON = new Services_JSON();
                $data = $Services_JSON->decode($json);
                if (is_null($data)) {
                    die("File <b>files.check</b> is empty or broken");
                }
                $origin = get_object_vars($data);

                # Current hash ------------
                $data = array();
                Util::readDir($data, INSTALL_PATH);
                $current = array();
                foreach ($data as $file) {
                    $current[str_replace(INSTALL_PATH, '', $file)] = md5_file($file);
                }

                $html = '<style type="text/css">
				table{border: solid 1px #000; border-collapse: collapse; font-family: Verdana, Arial, sans-serif; font-size: 14px}
				td{border: solid 1px #000; padding: 3px 5px; background-color: #fff; color: #000}
				.diff{background-color: #0066FF; color: #fff}
				.miss{background-color: #CC0000; color: #fff}
				</style>		
				<table cellpadding="0" cellspacing="0">
				<tr><td><strong>Filename</strong></td><td><strong>Status</strong></td></tr>
				';
                foreach ($origin as $file => $hash) {
                    if (isset($current[$file])) {
                        if ($current[$file] == $hash) {
                            
                        } else {
                            $html .= '<tr><td>' . $file . '</td><td class="diff">changed</td></tr>';
                        }
                    } else {
                        $html .= '<tr><td>' . $file . '</td><td class="miss">missing</td></tr>';
                    }
                }
                $html .= '<table>';
                echo $html;
                exit;
            }
        }
    }

}