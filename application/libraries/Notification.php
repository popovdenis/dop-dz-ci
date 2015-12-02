<?php

/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 28.11.2015
 * Time: 14:22
 */
class Notification
{
    const EMAIL_LIBRARY = 'email';

    public function __construct()
    {
        $this->load->library(self::EMAIL_LIBRARY); // load email library
    }

    public function setSender($email, $sender)
    {
        $this->email->from($email, $sender);

        return $this;
    }

    public function setRecipient($email)
    {
        $this->email->to($email);

        return $this;
    }

    public function setRecipientCC($email)
    {
        $this->email->cc($email);

        return $this;
    }

    public function setSubject($subject)
    {
        $this->email->subject($subject);

        return $this;
    }

    public function setMessage($message)
    {
        $this->email->message($message);

        return $this;
    }

    public function setAttach($path)
    {
        $this->email->attach($path);

        return $this;
    }

    function send()
    {
        if ($this->email->send()) {
            echo "Mail Sent!";
        } else {
            echo "There is error in sending mail!";
        }
    }
}