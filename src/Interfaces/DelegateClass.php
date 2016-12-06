<?php

namespace Interfaces;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Middleware\DelegateInterface;

require __DIR__.'/../../vendor/autoload.php';

class DelegateClass implements DelegateInterface
{
    function process(RequestInterface $request) : ResponseInterface
    {
        return 42;
    }
}

$delegate = new DelegateClass();

var_dump($delegate->process(new \Zend\Diactoros\ServerRequest()));
