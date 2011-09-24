<?php
/**
 * Created by JetBrains PhpStorm.
 * User: admin
 * Date: 19.09.11
 * Time: 9:15
 * To change this template use File | Settings | File Templates.
 */

class Developer extends Developer_Controller
{

    public $todo_status_list = array(
        '' => 'Все',
        'active' => 'Активные',
        'begin' => 'Начатые',
        'in_proccess' => 'В процессе',
        'delay' => 'Отложенные',
        'closed' => 'Закрытые',
    );

    /**
     * constructor of class Developer
     */
    public function __construct()
    {
        parent::__construct();
        $this->tpl->set_global('title', 'Панель разработчика');
    }

    /**
     * Default action controller
     * @return void
     */
    public function index()
    {
        $this->tpl->view('developer');
    }

    /**
     * Работа с модулем 'todo'
     * @param null $status
     * @return void
     */
    public function todo($status = null)
    {
        if ($this->input->post('create')) {
            if (Modules::run('todo/todo/create_item') !== false) {
                $this->tpl->set_global('message', 'Запись добавлена успешно');
            }
            else
                $this->tpl->set_global('error', 'Ошибка добавления записи');
        }
        if ($this->input->post('edit')) {
            $this->tpl->set_global('message', 'Изменено');
        }

        $this->tpl->set_global('title', 'Менеджер задач');
        $this->tpl->set('todo_status_list', $this->todo_status_list);
        $this->tpl->set('todo_cat_items', Modules::run('todo/todo/todo_cat_items'));
        $this->tpl->set('todo_status_items', Modules::run('todo/todo/todo_status_items'));
        $this->tpl->set('status', $status);
        /**
         * ``
         */
        switch ($status) {
            case 'active':
                $this->tpl->set('todo_items', Modules::run('todo/todo/todo_active_items'));
                break;
            case 'begin':
                $this->tpl->set('todo_items', Modules::run('todo/todo/todo_items', 'todo_status_id', 1));
                break;
            case 'in_proccess':
                $this->tpl->set('todo_items', Modules::run('todo/todo/todo_items', 'todo_status_id', 2));
                break;
            case 'delay':
                $this->tpl->set('todo_items', Modules::run('todo/todo/todo_items', 'todo_status_id', 3));
                break;
            case 'closed':
                $this->tpl->set('todo_items', Modules::run('todo/todo/todo_items', 'todo_status_id', 4));
                break;
            default:
                $this->tpl->set('todo_items', Modules::run('todo/todo/todo_items'));
                break;
        }
        $this->tpl->view('todo/view');
    }

    public function migration()
    {
        $this->tpl->view('migration/view');
    }
}
 
