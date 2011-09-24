<?php

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_Email            $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge         $dbforge
 * @property CI_Table            $table
 * @property CI_Session          $session
 * @property CI_FTP              $ftp
 * @property CI_Upload           $upload
 * @property Tpl                 $tpl
 *
 */

class MY_Controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('tpl');
    }
}



/**
 * Контроллер для аунтефикации пользователей
 */
class Auth_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (Modules::run('auth/auth/is_logged') === false) {
            redirect('login');
        }
    }

}

class Module_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
}

/**
 * Контроллер управляющий разделом для агентов
 */

class Agent_Controller extends Auth_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->set_layuot('agent');
        if (Modules::run('auth/auth/is_agent') === false) {
            redirect(site_url());
        }
    }
}

/**
 * Контроллер управляющий админкой
 */

class Admin_Controller extends Auth_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->tpl->set_layout('admin');
        if (Modules::run('auth/auth/is_admin') === false) {
            redirect(site_url());
        }
    }
}

/**
 * Контроллер управляющий разделом для разработчиков
 */

class Developer_Controller extends Auth_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->tpl->set_layout('developer');
        if (Modules::run('auth/auth/is_developer') === false) {
            redirect(site_url());
        }
    }
}