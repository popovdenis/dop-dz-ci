<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 03.12.2015
 * Time: 22:37
 */
class User_model extends CI_Model
{
    public function loadUser()
    {
        $query = $this->db->get('users');

        return $query->result_array();
    }

    public function getUsers()
    {
        $this->db
            ->select('id, firstname, lastname, email, created_at')
            ->from('users')
            ->order_by('id', 'desc');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getUser($id)
    {
        $this->db
            ->from('users')
            ->where('id', (int) $id);

        return $this->db->get()->row_array();
    }

    public function saveUser($data)
    {
        $this->db
            ->insert('users', $data);
    }

    public function updateUser($id, $data)
    {
        $this->db
            ->where('id', (int)$id)
            ->update('users', $data);
    }

    public function deleteUser($id)
    {
        $this->db
            ->where('id', (int)$id)
            ->delete('users');
    }
}