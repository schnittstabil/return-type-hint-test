<?php

namespace Interfaces;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Middleware\DelegateInterface;

require __DIR__.'/../../vendor/autoload.php';

$delegate = function (RequestInterface $request) : ResponseInterface {
    return 42;
};

var_dump($delegate(new \Zend\Diactoros\ServerRequest()));
