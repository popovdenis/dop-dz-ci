<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 23.01.2016
 * Time: 22:37
 */
class Article_model extends CI_Model
{
    public function getArticles($limit = 0, $offset = 0)
    {
        $this->db
            ->select('id, title, content, public_date')
            ->from('article')
            ->limit($limit, $offset)
            ->order_by('id', 'desc');
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * Get article by id.
     *
     * @param int $id Article ID.
     *
     * @return array
     */
    public function getArticle($id)
    {
        $this->db
            ->from('article')
            ->where('id', (int) $id);

        return $this->db->get()->row_array();
    }

    public function saveArticle($data)
    {
        $this->db
            ->insert('article', $data);
    }

    public function updateArticle($id, $data)
    {
        $this->db
            ->where('id', (int)$id)
            ->update('article', $data);
    }

    public function deleteArticle($id)
    {
        $this->db
            ->where('id', (int)$id)
            ->delete('article');
    }
}