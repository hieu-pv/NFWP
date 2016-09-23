<?php

use Illuminate\Http\Request;

function view($view, $data = [], $viewPath = null)
{
    $nfview = \NFWP\View\NFView::getInstance();
    if (isset($viewPath) && file_exists($viewPath)) {
        $nfview->setViewPath($viewPath);
    } else {
        $nfview->setViewPath(get_stylesheet_directory() . '/resources/views');
    }
    if (!isset($cachePath)) {
        $cachePath = $viewPath . '/../cache';
    }
    if (!file_exists($cachePath)) {
        mkdir($cachePath, '0755', true);
    }
    $nfview->setCachePath($cachePath);
    return $nfview->render($view, $data);
}

function nflog()
{
    return \NFWP\Log\NFLog::getInstance();
}

function request()
{
    return Request::capture();
}
