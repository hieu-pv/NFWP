<?php

use Symfony\Component\HttpFoundation\Request;

function view($view, $data = [])
{
    $nfview = \NFWP\View\NFView::getInstance();
    $nfview->setViewPath(get_stylesheet_directory() . '/resources/views');
    $nfview->setCachePath(get_stylesheet_directory() . '/resources/cache');
    return $nfview->render($view, $data);
}

function nflog()
{
    return \NFWP\Log\NFLog::getInstance();
}

function request()
{
    return Request::createFromGlobals();
}
