<?php namespace core\utils;

final class Mail
{
    private $to;
    private $subject;
    private $message;
    private $headers;
    private $from;

    use \core\traits\ClassMethods;

    public function __construct()
    {
        self::validateNumArgs(__FUNCTION__, func_num_args());

        $this->headers = array();

        if (defined('MAIL_IS_HTML')) {
            if (MAIL_IS_HTML) {
                $this->headers[] = 'MIME-Version: 1.0';
                $this->headers[] = 'Content-type: text/html; charset=' . (defined('MAIL_CHARSET') ? MAIL_CHARSET : 'utf-8');
            }
        }

        if (defined('MAIL_FROM')) {

            $this->from = MAIL_FROM;

            $this->headers[] = 'From: ' . MAIL_FROM;
            $this->headers[] = 'Return-path: ' . MAIL_FROM;
            $this->headers[] = 'Reply-to: ' . MAIL_FROM;
            $this->headers[] = 'X-Mailer: PHP/' . phpversion();
        }
    }

    private function to($to)
    {
        $this->to = null;

        if (is_array($to) and count($to) > 0) {
            $this->to = implode(',', $to);
        } else if (is_string($to) and strlen($to) > 0) {
            $this->to = trim($to);
        }
    }

    public function subject($subject)
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 1, 1);
        self::validateArgType(__FUNCTION__, $subject, 1, ['string']);

        $this->subject = null;

        if (is_string($subject) and strlen($subject) > 0) {
            $this->subject = substr(trim($subject), 0, 70);
        }
    }

    public function message($message)
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 1, 1);
        self::validateArgType(__FUNCTION__, $message, 1, ['string']);

        $this->message = null;

        if (is_string($message) and strlen($message) > 0) {
            $this->message = wordwrap(trim($message), 70);
        }
    }

    public function send($to)
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 1, 1);
        self::validateArgType(__FUNCTION__, $to, 1, ['string', 'array']);

        $this->to($to);

        // TODO: Define a error message when any parameter is not defined.
        if (!is_null($this->to) and !is_null($this->subject) and !is_null($this->message) and is_string($this->from)) {
            return mail($this->to, $this->subject, $this->message, implode("\r\n", $this->headers), '-f' . $this->from);
        }
        return false;
    }
}
