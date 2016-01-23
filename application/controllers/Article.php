<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 23.01.2016
 * Time: 22:29
 */
class Article extends CI_Controller
{
    public function index()
    {
        $this->load->library('form_validation');
        if (isset($_POST['add'])) {
            $this->load->model('rules_model');
            $this->form_validation->set_rules($this->rules_model->add_rules, $this->rules_model->rules_messages);
            $result = $this->form_validation->run();
            if ($result) {
                $data = array(
                    'title' => $this->input->post('title'),
                    'text' => $this->input->post('text'),
                    'date' => $this->input->post('date'),
                );
                $this->load->model('article_model');
                $this->article_model->add_article($data);

                $this->load->view('article/view');
            } else {
                $this->load->view('article/add');
            }
        } else {
            $this->load->view('article/add');
        }
    }

    public function title_check($str)
    {
        if ($str == '12345')
        {
            $this->form_validation->set_message('title_check', 'The {field} field can not be the word "test"');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}