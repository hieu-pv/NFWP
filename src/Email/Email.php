<?php

namespace NFWP\Email;

include_once ABSPATH . '/wp-includes/pluggable.php';

use Exception;

class Email
{
    /**
     * Array or comma-separated list of email addresses to send message.
     *
     * @var string|array
     */
    public $address;

    /**
     * Email subject
     *
     * @var string
     */
    public $email_subject;

    /**
     * Message contents
     *
     * @var string
     */
    public $content = '';

    /**
     * Additional headers.
     *
     * @var string|array
     */
    public $headers = [];

    /**
     * Files to attach.
     * @var string|array
     */
    public $attachments = [];

    /**
     * Send mail, similar to PHP’s mail
     *
     * @return bool - Whether the email contents were sent successfully.
     */
    public function __construct($content = null)
    {
        if (isset($content)) {
            $this->content = $content;
        }
    }

    public function from()
    {
        $args = func_get_args();
        if (func_num_args() > 2) {
            throw new Exception("too many parameters for this operator function", 1);
        }
        if (!filter_var($args[0], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("first parameter need to a valid email", 1);
        } else {
            if (func_num_args() == 1) {
                $this->headers[] = "From: {$args[0]} <{$args[0]}>";
            } else {
                $this->headers[] = "From: {$args[1]} <{$args[0]}>";
            }
        }
        return $this;
    }

    public function to($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("please insert a valid email address", 1);
        }
        $this->address   = $email;
        // $this->headers[] = "To {$email}";
        return $this;
    }

    public function attach($file)
    {
        if (!file_exists($file)) {
            throw new Exception("attachment does not exist", 1);
        }
        $this->attachments[] = $file;
        return $this;
    }

    public function subject($subject)
    {
        $this->email_subject = $subject;
    }

    public function send()
    {
        $sent = wp_mail($this->address, $this->email_subject, $this->content, $this->headers, $this->attachments);
        return $sent;
    }
}
