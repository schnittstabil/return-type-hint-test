<?php

namespace Interfaces;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\Middleware\DelegateInterface;

require __DIR__.'/../../vendor/autoload.php';

class Delegate
{
    public function __invoke(RequestInterface $request) : ResponseInterface
    {
        return 42;
    }
}

$delegate = new Delegate();

var_dump($delegate(new \Zend\Diactoros\ServerRequest()));
