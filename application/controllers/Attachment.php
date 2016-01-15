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
                $attachment = $this->upload->data();
//                $this->resize($attachment);
                $this->watermark($attachment);
            } else {
                echo '<pre>';
                var_dump($this->upload->display_errors());
                echo '</pre>';exit;
            }
        }

        $this->load->view('attachment/index');
    }

    public function resize($attachment)
    {
        $imageTypes = array('.bmp', '.gif', '.jpeg', '.jpg', '.jpe', '.png');

        $config['image_library']  = 'gd2';
        $config['source_image']   = $attachment['full_path'];
        $config['create_thumb']   = true;
        $config['thumb_marker']   = '_thumb';
        $config['maintain_ratio'] = true;
        $config['width'] = 75;
        $config['height'] = 50;

        $this->load->library('image_lib', $config); // загружаем библиотеку
        $this->image_lib->resize();
    }

    public function watermark($attachment)
    {
        $config['source_image']	= $attachment['full_path'];
        $config['wm_text'] = 'Copyright 2009 - Tutulkin';
        $config['wm_type'] = 'text';
        $config['wm_font_path'] = './system/fonts/texb.ttf';
        $config['wm_font_size']	= '14';
        $config['wm_font_color'] = 'e5e5e5';
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'center';
//        $config['wm_padding'] = '20';

        $this->load->library('image_lib', $config);

        $this->image_lib->watermark();
    }
}