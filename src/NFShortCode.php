<?php

namespace NFWP;

use Exception;
use Philo\Blade\Blade;

class NFShortCode
{
    public function __construct()
    {
        /**
         * aggregate of all methods
         *
         * @var array
         */
        $methods = get_class_methods($this);

        /**
         * do not create short code with methods in this array
         *
         * @var array
         */
        $ignore = ['__construct'];

        foreach ($ignore as $method) {
            if (in_array($method, $methods)) {
                $key = array_search($method, $methods);
                array_splice($methods, $key, 1);
            }
        }

        /**
         * create shortcode
         *
         */
        foreach ($methods as $shortcode) {
            add_shortcode($shortcode, [$this, $shortcode]);
        }
    }
}
