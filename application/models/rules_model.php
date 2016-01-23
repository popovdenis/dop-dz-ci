<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 23.01.2016
 * Time: 22:38
 */
class Rules_model extends CI_Model
{
    public $add_rules = array(
        array(
            'field' => 'title',
            'label' => 'Название статьи',
            'rules' => 'required|min_length[5]|max_length[50]|trim|callback_title_check'
        ),
    );

    public $rules_messages = array(
        'title' => 'Название статьи некорректное'
    );
}