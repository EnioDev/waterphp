<?php namespace core\utils;

final class Mail
{
    private $to;
    private $subject;
    private $message;
    private $headers;

    function __construct()
    {
        $this->headers = array();

        if (MAIL_IS_HTML) {
            $this->headers[] = 'MIME-Version: 1.0';
            $this->headers[] = 'Content-type: text/html; charset=' . MAIL_CHARSET;
        }

        $this->headers[] = 'From: ' . MAIL_FROM;
        $this->headers[] = 'Return-path: ' . MAIL_FROM;
        $this->headers[] = 'Reply-to: ' . MAIL_FROM;
        $this->headers[] = 'X-Mailer: PHP/' . phpversion();
    }

    private function setTo($to)
    {
        if (is_array($to)) {
            $this->to = implode(',', $to);
        } else if (is_string($to)) {
            $this->to = trim($to);
        } else {
            $this->to = false;
        }
    }

    private function setSubject($subject)
    {
        if (is_string($subject) and strlen($subject) > 0) {
            $this->subject = substr(trim($subject), 0, 70);
        } else {
            $this->subject = '';
        }
    }

    private function setMessage($message)
    {
        if (is_string($message) and strlen($message) > 0) {
            $this->message = wordwrap(trim($message), 70);
        } else {
            $this->message = false;
        }
    }

    public function subject($subject)
    {
        $this->setSubject($subject);
    }

    public function message($message)
    {
        $this->setMessage($message);
    }

    public function send($to)
    {
        $this->setTo($to);

        $accept = false;

        if ($this->to and $this->message) {
            $accept = mail($this->to, $this->subject, $this->message, implode("\r\n", $this->headers), '-f' . MAIL_FROM);
        }
        return $accept;
    }
}