<?php

namespace Interfaces;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Middleware\DelegateInterface;

require __DIR__.'/../../vendor/autoload.php';

class DelegateA
{
    public static function process(RequestInterface $request) : ResponseInterface
    {
        return 42;
    }
}

class DelegateB extends DelegateA
{
    public static function process(RequestInterface $request) : ResponseInterface
    {
        return new \Zend\Diactoros\Response();
    }
}

$delegate = ['Interfaces\DelegateB', 'parent::process'];

var_dump(call_user_func($delegate, new \Zend\Diactoros\ServerRequest()));
