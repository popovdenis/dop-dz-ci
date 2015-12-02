<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 28.11.2015
 * Time: 0:12
 */
class News extends CI_Controller
{
    public function show($id)
    {
        $this->load->model('news_model');
        $news = $this->news_model->get_news($id);
        $data['title'] = $news['title'];
        $data['description'] = $news['description'];
        $this->load->view('news_article', $data);
    }
}