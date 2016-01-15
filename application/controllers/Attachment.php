<?php

/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 15.01.2016
 * Time: 23:57
 */
class  Attachment extends CI_Controller
{
    public function upload()
    {
        if (!empty($_FILES)) {
            $fieldname = array_keys($_FILES)[0];
//            $config     = $this->load->config('upload');
            $config = array(
                'upload_path' => dirname(BASEPATH) . '/files/',
                'allowed_types' => 'bmp|flv|avi|jpeg|jpg|gif|bmp|png|FLV|AVI|JPEG|JPG|GIF|BMP|PNG|PDF|xlsx|xls|pdf|zip|rar|doc|docx',
                'max_size' => 50000000
            );
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755);
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload($fieldname)) {
                echo '<pre>';
                var_dump($this->upload->data());
                echo '</pre>';exit;

            } else {
                echo '<pre>';
                var_dump($this->upload->display_errors());
                echo '</pre>';exit;
            }
        }

        $this->load->view('attachment/index');
    }
}