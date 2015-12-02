<?php

class Items_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_all()
    {
        return $this->db->get('items')->result();
    }

    function get($id)
    {
        $r = $this->db->where('id', $id)->get('items')->result();
        if ($r) {
            return $r[0];
        }
        return false;
    }

    function setup_payment($item_id, $email, $key)
    {
        $data = array(
            'item_id' => $item_id,
            'key' => $key,
            'email' => $email,
            'active' => 0 // hasn't been purchased yet
        );
        $this->db->insert('purchases', $data);
    }

    function confirm_payment($key, $paypal_email, $paypal_txn_id)
    {
        $data = array(
            'purchased_at' => time(),
            'active' => 1,
            'paypal_email' => $paypal_email,
            'paypal_txn_id' => $paypal_txn_id
        );
        $this->db->where('key', $key);
        $this->db->update('purchases', $data);
    }

    function get_purchase_by_key($key)
    {
        $r = $this->db->where('key', $key)->get('purchases')->result();
        if ($r) {
            return $r[0];
        }
        return false;
    }

    function log_download($item_id, $purchase_id, $ip_address, $user_agent)
    {
        $data = array(
            'item_id' => $item_id,
            'purchase_id' => $purchase_id,
            'download_at' => time(),
            'ip_address' => $ip_address,
            'user_agent' => $user_agent
        );
        $this->db->insert('downloads', $data);
    }

    function get_purchase_downloads($purchase_id, $limit)
    {
        return $this->db->where('purchase_id', $purchase_id)->limit($limit)->order_by('id', 'desc')->get(
            'downloads'
        )->result();
    }

}