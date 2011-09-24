<?php
/**
 * Created by JetBrains PhpStorm.
 * User: admin
 * Date: 18.09.11
 * Time: 8:50
 * To change this template use File | Settings | File Templates.
 */

/**
 * @property Objects_Cat_Model                    $objects_cat_model
 */

class Objects extends Module_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('objects_cat_model');
        $this->load->library('form_validation');
    }

    /**
     * @param int $id
     * @return bool
     */
    public function item($id)
    {
        return $this->objects_cat_model->find_by_pk($id);
    }

    public function objects_cat_item($id)
    {
        return $this->objects_cat_model->find_by_pk($id);
    }

    public function objects_cat_items()
    {
        return $this->objects_cat_model->find_all();
    }

    /**
     * Создание новой записи
     * @param string $model_name
     * @return bool
     */
    public function create_item($model_name)
    {
        switch ($model_name) {
            case 'objects_cat':
                $this->form_validation->set_rules('description', 'Наименование', 'required|trim|xss_clean|min_length[4]|max_length[128]');
                $this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');
                if ($this->form_validation->run() !== false)
                    $this->objects_cat_model->insert(array('description' => $this->input->post('description')));
                else
                    return false;
                break;
        }
    }

    /**
     * @param string $model_name
     * @param int $id
     * @return boolean
     */
    public function delete_item($model_name, $id)
    {
        if ($this->input->is_ajax_request() !== false)
            switch ($model_name) {
                case 'objects_cat':
                    if (!$this->objects_cat_model->delete('objects_cat_id', $id))
                        return false;
                    break;
            }
    }

    public function update_item($model_name, $id)
    {
        if ($this->input->is_ajax_request() !== false) {

        }
    }
}
 
