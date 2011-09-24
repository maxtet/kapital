<?php
/**
 * Date: 17.09.11
 * Time: 18:57
 * To change this template use File | Settings | File Templates.
 */

/**
 * @property  Auth_Model                          $auth_model
 */
class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->tpl->set_layout('auth');
    }

    public function is_logged()
    {
        if (!$this->session->userdata('uid')) {
            return false;
        }
    }

    public function is_agent()
    {
        if ($this->session->userdata('role') != 2) {
            return false;
        }
    }

    public function is_admin()
    {
        if ($this->session->userdata('role') != 3) {
            return false;
        }
    }

    public function is_developer()
    {
        if ($this->session->userdata('role') != 4) {
            return false;
        }
    }

    public function is_active()
    {
        if ($this->session->userdata('active') != 1) {
            return false;
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Пользователь', 'required|trim|xss_clean|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('password', 'Пароль', 'required|trim|xss_clean|min_length[6]|max_length[16]');
        $this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');
        $this->tpl->set('title', 'Вход в систему');
        if ($this->form_validation->run() === false) {
            $this->tpl->view('login');
        }
        elseif ($this->auth_model->checkUser() === false)
        {
            $this->tpl->set('auth_error', '<div class="form_error">Неверные имя пользователя или пароль</div>');
            $this->tpl->view('login');
        }
        else
        {
            $this->session->set_userdata(array(
                                              'uid' => (int)$this->auth_model->checkUser()->user_id,
                                              'username' => $this->auth_model->checkUser()->username,
                                              'role' => $this->auth_model->checkUser()->user_roles_id
                                         ));
            $this->auth_model->activateUser();
            switch ($this->session->userdata('role')) {
                case 1:
                    redirect(site_url());
                    break;
                case 2:
                    redirect(site_url('agent'));
                    break;
                case 3:
                    redirect(site_url('admin'));
                    break;
                case 4:
                    redirect(site_url('developer'));
                    break;
                default:
                    redirect(site_url('error'));
                    break;
            }
            redirect(site_url('admin'));
        }
    }

    public function logout()
    {
        $this->auth_model->deactivateUser();
        $this->session->unset_userdata('uid');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->sess_destroy();
        redirect(site_url('admin'));
    }
}
 
