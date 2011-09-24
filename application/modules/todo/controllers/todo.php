<?php
/**
 * Created by JetBrains PhpStorm.
 * User: admin
 * Date: 19.09.11
 * Time: 12:41
 * To change this template use File | Settings | File Templates.
 */

/**
 * @property Todo_Model                          $todo_model
 * @property Todo_Cat_Model                      $todo_cat_model
 * @property Todo_Status_Model                   $todo_status_model
 */

class Todo extends Module_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('todo_model');
        $this->load->model('todo_cat_model');
        $this->load->model('todo_status_model');
    }

    public function todo_cat_items()
    {
        return $this->todo_cat_model->find_all();
    }

    public function todo_status_items()
    {
        return $this->todo_status_model->find_by_all();
    }

    public function todo_status_item($field = null, $val = null)
    {
        if ($field && $val)
            $data = array($field => $val);
        return $this->todo_model->find_by($data);
    }

    public function todo_active_items()
    {
        $this->db->where_not_in('todo_status_id', 4);
        return $this->db->get('todo')->result();
    }

    public function todo_items($field = null, $val = null)
    {
        if ($field && $val)
            $data = array($field => $val);
        return $this->todo_model->find_by_all($data);
    }

    public function create_item()
    {
        $this->form_validation->set_rules('todo_cat', 'Тип задачи', 'required');
        $this->form_validation->set_rules('todo_status', 'Состояние', 'required');
        $this->form_validation->set_rules('description', 'Описание', 'required|trim|xss_clean|max_length[255]');
        $this->form_validation->set_error_delimiters('<div class="form_error">', '</div> ');
        if ($this->form_validation->run() !== false) {
            $this->todo_model->insert(array(
                                           'todo_cat_id' => $this->input->post('todo_cat'),
                                           'todo_status_id' => $this->input->post('todo_status'),
                                           'description' => $this->input->post('description'),
                                           'date_create' => date('Y-m-d h:i'),
                                           'developer' => $this->session->userdata('username')
                                      ));
        }
        else
            return false;
    }

    public function edit_item($id)
    {
        if ($this->input->is_ajax_request()) {
            $this->db->update('todo', array(
                                           'todo_cat_id' => $this->input->post('todo_cat'),
                                           'todo_status_id' => $this->input->post('todo_status'),
                                           'description' => $this->input->post('description')
                                      ), array('todo_id' => $id));
            $this->load->view('ajax/todo/edit_item', array(
                                                     'todo_cat_items' => $this->todo_cat_items(),
                                                     'todo_status_items' => $this->todo_status_items(),
                                                     'todo' => $this->todo_model->find_by_pk($id)
                                                ));
        }
    }
}
 
