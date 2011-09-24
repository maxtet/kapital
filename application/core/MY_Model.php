<?php
/**
 * Date: 16.09.11
 * Time: 23:47
 * To change this template use File | Settings | File Templates.
 */

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_Email            $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge         $dbforge
 * @property CI_Session          $session
 * @property CI_FTP              $ftp
 * @property CI_Upload           $upload
 * @property Tpl                 $tpl
 *
 */

class MY_Model extends CI_Model
{
    protected $table;
    protected $primary_key;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Добавление записи в базу
     * @param array $data
     * @return bool
     */
    public function insert($data = array())
    {
        if (!$this->db->insert($this->table, $data))
            return false;
    }

    /**
     * @property Выборка данных из таблицы
     * @param null $field
     * @return bool
     */
    public function find_all($field = null)
    {
        if (!$field)
            $result = $this->db->get($this->table)->result();
        else
        {
            $this->db->select('*')->from($this->table)->order_by($field);
            $result = $this->db->get()->result();
        }
        if (!$result)
            return false;
        else
            return $result;
    }

    public function find_by_all($data = null)
    {
        if ($data) {
            $result = $this->db->get_where($this->table, $data)->result();
        }
        else
            $result = $this->db->get($this->table)->result();
        if (!$result)
            return false;
        else
            return $result;
    }

    public function find_by_pk($primary_key)
    {
        $result = $this->db->get_where($this->table, array(
                                                          $this->primary_key => $primary_key
                                                     ))->row();
        if (!$result)
            return false;
        else
            return $result;
    }

    public function find_by($data = null)
    {
        if ($data) {
            $result = $this->db->get_where($this->table, $data)->row();
        }
        else
            $result = $this->db->get($this->table)->row();
        if (!$result)
            return false;
        else
            return $result;
    }

    public function update($data = array(), $value)
    {
        $this->db->update($this->table, $data, array($this->primary_key => $value));
    }

    public function delete($field, $val)
    {
        $this->db->delete($this->table, array($field => $val));
    }
}
 
