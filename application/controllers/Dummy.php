<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 03.12.2015
 * Time: 22:12
 */
class Dummy extends CI_Controller
{
    public function index()
    {
//        echo 'Hello World!';
        $this->load->view('dummy_index');
    }

    public function about()
    {
        $data = [
            'firstname' => 'Denis',
            'lastname' => 'Popov',
        ];
        $this->load->view('dummy_about', $data);
    }

    public function users()
    {
        $this->load->model('user_model', 'user');
        $data['users'] = $this->user->loadUser();
        $this->load->view('dummy_user', $data);
    }
}