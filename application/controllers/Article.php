<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 24.01.2016
 * Time: 10:42
 */
class Article extends CI_Controller
{
    const PER_PAGE = 5;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model', 'article');
    }

    public function index()
    {
        $articles = $this->article->getArticles();

        $this->load->library('pagination');

        $config['base_url'] = site_url('article/index/page');
        $config['total_rows'] = count($articles);
        $config['per_page'] = self::PER_PAGE;

        $this->pagination->initialize($config);
        $pageId = (int)$this->uri->segment(4);
        $articles = $this->article->getArticles(self::PER_PAGE, $pageId);

        $data['articles'] = $articles;

        $this->load->view('article/info', $data);
    }

    public function add()
    {
        $this->load->model('rules_model', 'rules');

        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->rules->getRules());

        if (isset($_POST['add_article'])) {
            if ($this->form_validation->run()) {
                $data = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'public_date' => (new DateTime($this->input->post('public_date')))->format('Y-m-d'),
                );
                $this->article->saveArticle($data);

                redirect('article');
            }
        }

        $this->load->view('article/add');
    }

    public function getArticle($articleId)
    {
        $article = $this->article->getArticle($articleId);
        $result = empty($article) ? [] : $article;

        echo json_encode($result);
    }

    public function update($articleId)
    {
        $title = $this->input->post('title', true);
        $content = $this->input->post('content', true);
        $public_date = $this->input->post('public_date', true);

        $result = false;
        if (!empty($articleId)) {
            $this->article->updateArticle(
                $articleId,
                array(
                    'title' => $title,
                    'content' => $content,
                    'public_date' => $public_date
                )
            );
            $result = true;
        }
        $message = $result ? 'Статья успешно сохранена' : 'Статья не сохранена';

        $this->session->set_flashdata('update_result', ['success' => $result, 'message' => $message]);

        echo true;
    }

    public function delete($articleId)
    {
        if (!empty($articleId)) {
            $this->article->deleteArticle($articleId);
        }
    }
}