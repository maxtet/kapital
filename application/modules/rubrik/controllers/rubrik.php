<?php
/**
 * Date: 17.09.11
 * Time: 0:05
 * To change this template use File | Settings | File Templates.
 */

/**
 * @property Rubrik_Model                         $rubrik_model
 *
 */

class Rubrik extends Module_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('rubrik_model');
        $this->load->library('form_validation');
    }

    public function items()
    {
        return $this->rubrik_model->find_all('code');
    }

    public function create_item()
    {
        $this->form_validation->set_rules('objects_cat_id', 'Категория объектов', 'required');
        $this->form_validation->set_rules('code', 'Код рубрики', 'required|trim|xss_clean|min_length[3]|max_length[3]');
        $this->form_validation->set_rules('description', 'Рубрика', 'required|trim|xss_clean|min_length[4]|max_length[128]');
        $this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');

        if ($this->form_validation->run() !== false) {
            $this->rubrik_model->insert(array(
                                             'objects_cat_id' => $this->input->post('objects_cat_id'),
                                             'code' => $this->input->post('code'),
                                             'description' => $this->input->post('description')
                                        ));
        }
        else
            return false;
    }

    public function delete_item($id)
    {

        if ($this->input->is_ajax_request()) {
            if (Modules::run('/auth/auth/is_logged') === false) {
                redirect(site_url('admin'));
            }
            $this->rubrik_model->delete('rubrik_id', $id);
        }
    }

}
 
