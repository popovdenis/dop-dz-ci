<?php

/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 28.11.2015
 * Time: 0:14
 */
class News_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news($id)
    {
        if ($id != false) {
            $query = $this->db->get_where('news', array('id' => $id));
            return $query->row_array();
        } else {
            return false;
        }
    }
}