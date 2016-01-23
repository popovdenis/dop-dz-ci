<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 03.12.2015
 * Time: 22:37
 */
class Gallery_model extends CI_Model
{
    public function getGalleries()
    {
        $this->db
            ->select('id, file_name, file_ext')
            ->from('gallery');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function saveGallery($data)
    {
        $this->db->insert('gallery', $data);
    }

    public function deleteGallery($id)
    {
        $this->db
            ->where('id', (int)$id)
            ->delete('gallery');
    }
}