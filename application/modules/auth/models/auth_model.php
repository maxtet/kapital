<?php
/**
 * Date: 17.09.11
 * Time: 20:34
 * To change this template use File | Settings | File Templates.
 */

class Auth_Model extends MY_Model
{
    protected $table = 'user';
    protected $primary_key = 'user_id';

    public function checkUser()
    {
        $result = $this->db->get_where($this->table, array(
                                                          'username' => $this->input->post('username'),
                                                          'password' => $this->input->post('password')
                                                     ))->row();
        if (!$result)
            return false;
        else
            return $result;
    }

    public function activateUser()
    {
        return $this->db->update($this->table, array('active' => 1), 'user_id = '.$this->session->userdata('uid'));
    }

    public function deactivateUser()
    {
        return $this->db->update($this->table, array('active' => 0), 'user_id = '.$this->session->userdata('uid'));
    }
}
 
