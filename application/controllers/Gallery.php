<?php

/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 16.01.2016
 * Time: 11:20
 */
class Gallery extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('gallery_model');
    }

    private function upload()
    {
        $data = array(
            'success' => null,
            'message' => '',
        );
        $config = array(
            'upload_path' => dirname(BASEPATH) . '/files/',
            'allowed_types' => 'jpeg|jpg|gif|bmp|png',
            'max_size' => 50000000,
            'encrypt_name' => true
        );
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755);
        }
        $this->load->library('upload', $config);

        $fieldname = array_keys($_FILES)[0];
        if (!$this->upload->do_upload($fieldname)) {
            $data['success'] = false;
            $data['message'] = $this->upload->display_errors();
        } else {
            $data['success'] = true;
            $data['message'] = 'File is uploaded';
            $data['upload_data'] = $this->upload->data();
        }

        return $data;
    }

    private function resize($sourceImage)
    {
        $config['image_library'] = 'gd2'; // выбираем библиотеку
        $config['source_image']	= $sourceImage;
        $config['create_thumb'] = TRUE; // ставим флаг создания эскиза
        $config['maintain_ratio'] = TRUE; // сохранять пропорции
        $config['thumb_marker']   = '_thumb';
        $config['width']	= 75; // и задаем размеры
        $config['height']	= 50;

        $this->image_lib->initialize($config);
        $this->image_lib->resize(); // и вызываем функцию
    }

    private function watermark($sourceImage)
    {
        $config['source_image']	= $sourceImage;
        $config['wm_text'] = 'Copyright 2016';
        $config['wm_type'] = 'text';
        $config['wm_font_path'] = './system/fonts/texb.ttf';
        $config['wm_font_size']	= '16';
        $config['wm_font_color'] = '000000';
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'center';
//        $config['wm_padding'] = '20';

        $this->image_lib->initialize($config);
        $this->image_lib->watermark();
    }

    public function index()
    {
        $data['galleries'] = $this->gallery_model->getGalleries();

        $this->load->view('gallery/index', $data);
    }

    public function add()
    {
        $data = array();
        if (!empty($_FILES)) {
            $data = $this->upload();
            if ($data['success']) {
                $this->load->library('image_lib'); // загружаем библиотеку
                $this->watermark($data['upload_data']['full_path']);
                $this->resize($data['upload_data']['full_path']);
                $this->gallery_model->saveGallery(
                    array(
                        'file_name' => $data['upload_data']['raw_name'],
                        'file_ext' => $data['upload_data']['file_ext']
                    )
                );

                redirect('gallery/index');
            }
        }
        $this->load->view('gallery/add', $data);
    }

    public function delete()
    {

    }
}