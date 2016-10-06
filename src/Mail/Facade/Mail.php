<?php

namespace NFWP\Email\Facade;

use Exception;
use NFWP\Mail\Mail as NFMail;

class Mail
{
    public static function send()
    {
        $args     = func_get_args();
        $view     = $args[0];
        $data     = [];
        $viewPath = null;
        $callable = null;
        switch (func_num_args()) {
            case 1:
                throw new Exception("not enough parameter", 1);
                break;
            case 2:
                if (is_callable($args[1])) {
                    $callable = $args[1];
                } else {
                    throw new Exception("The second parameter must be a closure", 1);
                }
                break;
            case 3:
                if (is_array($args[1])) {
                    $data = $args[1];
                } else {
                    if (!is_string($args[1])) {
                        throw new Exception("The second parameter must be a array or a string", 1);
                    } else {
                        if (!file_exists($args[1])) {
                            throw new Exception("directory not found", 1);
                        } else {
                            $viewPath = $args[1];
                        }
                    }
                }
                if (is_callable($args[2])) {
                    $callable = $args[2];
                } else {
                    throw new Exception("The third parameter must be a closure", 1);
                }
                break;
            case 4:
                if (!is_array($args[1])) {
                    throw new Exception("The second parameter must be an array", 1);
                } else {
                    $data = $args[1];
                }
                if (!file_exists($args[2])) {
                    throw new Exception("The third parameter must be a directory", 1);
                } else {
                    $viewPath = $args[2];
                }
                if (!is_callable($args[3])) {
                    throw new Exception("The fourth parameter must be a closure", 1);
                } else {
                    $callable = $args[3];
                }
                break;
            default:
                throw new Exception("Too many parameters for this operator function", 1);
        }
        $content = view($view, $data, $viewPath);
        $email   = new NFMail($content);
        call_user_func($callable, $email);
        return $email->send();
    }
}
