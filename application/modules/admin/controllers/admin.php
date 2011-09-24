<?php
/**
 * Date: 17.09.11
 * Time: 19:26
 * To change this template use File | Settings | File Templates.
 */

class Admin extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->tpl->set_global('title', 'Панель администратора');
    }

    public function index()
    {
        $this->tpl->view('admin');
    }

    public function rubrik()
    {
        if ($this->input->post('create')) {
            if (Modules::run('rubrik/rubrik/create_item') !== false) {
                $this->tpl->set_global('message', 'Запись добавлена удачно');
            }
            else
            {
                $this->tpl->set_global('error', 'Ошибка добавления записи');
            }
        }
        $this->tpl->set_global('title', 'Менеджер рубрик');
        $this->tpl->set('items', Modules::run('rubrik/rubrik/items'));
        $this->tpl->view('rubrik/view');
    }

    public function objects($model_name)
    {
        switch ($model_name) {
            case 'objects_cat':
                if ($this->input->post('create')) {
                    if (Modules::run('objects/objects/create_item', $model_name) !== false) {
                        $this->tpl->set_global('message', 'Запись добавлена успешно');
                    }
                    else
                        $this->tpl->set_global('error', 'Ошибка добавления записи');
                }
                $this->tpl->set_global('title', 'Менеджер категорий объектов');
                $this->tpl->set('items', Modules::run('objects/objects/objects_cat_items'));
                $this->tpl->view('objects_cat/view');
                break;
        }
    }
}
 
