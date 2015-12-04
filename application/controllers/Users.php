<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 03.12.2015
 * Time: 23:35
 */
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $this->get_users();
    }

    public function add()
    {
        $data = [
            'firstname' => 'John-' . rand(10, 100),
            'lastname' => 'Dogh-' . rand(10, 100),
            'email' => 'jogh.dogh-' . rand(10, 100) . '@mail.ru',
            'created_at' => (new DateTime())->format('Y-m-d H:i:s'),
        ];
        $this->load->model('user_model');
        $this->user_model->saveUser($data);

        redirect('/users');
    }

    public function edit($id)
    {
        $data = [
            'email' => 'test-' . rand(10, 100) . '@gmail.com'
        ];
        $this->load->model('user_model');
        $this->user_model->updateUser($id, $data);
        $data['user'] = $this->user_model->getUser($id);

        redirect('/users');
    }

    public function get_user($id)
    {
        $this->load->model('user_model');
        $user = $this->user_model->getUser($id);
        $data['user'] = $user;

        $this->load->view('users/users', $data);
    }

    public function get_users()
    {
        $this->load->model('user_model');
        $data['users'] = $this->user_model->getUsers();

        $this->load->view('users/users', $data);
    }

    public function delete($id)
    {
        $this->load->model('user_model');
        $this->user_model->deleteUser($id);

        redirect('/users');
    }
}