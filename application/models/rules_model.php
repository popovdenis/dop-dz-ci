<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 23.01.2016
 * Time: 22:38
 */
class Rules_model extends CI_Model
{
    private $rules = array(
        array(
            'field' => 'title',
            'label' => 'Название статьи',
            'rules' => 'required|min_length[5]|max_length[50]|trim'
        ),
        array(
            'field' => 'content',
            'label' => 'Содержимое статьи',
            'rules' => 'required|max_length[200]|trim'
        ),
        array(
            'field' => 'public_date',
            'label' => 'Дата публикации',
            'rules' => 'required|max_length[10]|trim'
        ),
    );//callback_title_check

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }
}