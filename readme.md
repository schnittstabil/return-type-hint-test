# Return Type-Hint Test
```
PHP 7.0.13-1~dotdeb+8.1 (cli) ( NTS )
Copyright (c) 1997-2016 The PHP Group
Zend Engine v3.0.0, Copyright (c) 1998-2016 Zend Technologies
    with Zend OPcache v7.0.13-1~dotdeb+8.1, Copyright (c) 1999-2016, by Zend Technologies
```

---

## src/Callables/AnonymousCallable.php

### Script

```php
$delegate = function (RequestInterface $request) : ResponseInterface {
    return 42;
};

var_dump($delegate(new \Zend\Diactoros\ServerRequest()));
```
### Output

```
PHP Fatal error:  Uncaught TypeError: Return value of Interfaces\{closure}() must be an instance of Psr\Http\Message\ResponseInterface, integer returned in /return-type-hint-test/src/Callables/AnonymousCallable.php:13
Stack trace:
#0 /return-type-hint-test/src/Callables/AnonymousCallable.php(16): Interfaces\{closure}(Object(Zend\Diactoros\ServerRequest))
#1 {main}
  thrown in /return-type-hint-test/src/Callables/AnonymousCallable.php on line 13

```

---

## src/Callables/CallableFunction.php

### Script

```php
function delegate(RequestInterface $request) : ResponseInterface
{
    return 42;
}

var_dump(delegate(new \Zend\Diactoros\ServerRequest()));
```
### Output

```
PHP Fatal error:  Uncaught TypeError: Return value of Interfaces\delegate() must be an instance of Psr\Http\Message\ResponseInterface, integer returned in /return-type-hint-test/src/Callables/CallableFunction.php:14
Stack trace:
#0 /return-type-hint-test/src/Callables/CallableFunction.php(17): Interfaces\delegate(Object(Zend\Diactoros\ServerRequest))
#1 {main}
  thrown in /return-type-hint-test/src/Callables/CallableFunction.php on line 14

```

---

## src/Callables/InvokableClass.php

### Script

```php
class Delegate
{
    public function __invoke(RequestInterface $request) : ResponseInterface
    {
        return 42;
    }
}

$delegate = new Delegate();

var_dump($delegate(new \Zend\Diactoros\ServerRequest()));
```
### Output

```
PHP Fatal error:  Uncaught TypeError: Return value of Interfaces\Delegate::__invoke() must be an instance of Psr\Http\Message\ResponseInterface, integer returned in /return-type-hint-test/src/Callables/InvokableClass.php:16
Stack trace:
#0 /return-type-hint-test/src/Callables/InvokableClass.php(22): Interfaces\Delegate->__invoke(Object(Zend\Diactoros\ServerRequest))
#1 {main}
  thrown in /return-type-hint-test/src/Callables/InvokableClass.php on line 16

```

---

## src/Callables/ObjectMethod.php

### Script

```php
class Delegate
{
    public function process(RequestInterface $request) : ResponseInterface
    {
        return 42;
    }
}

$delegate = [new Delegate(), 'process'];

var_dump($delegate(new \Zend\Diactoros\ServerRequest()));
```
### Output

```
PHP Fatal error:  Uncaught TypeError: Return value of Interfaces\Delegate::process() must be an instance of Psr\Http\Message\ResponseInterface, integer returned in /return-type-hint-test/src/Callables/ObjectMethod.php:16
Stack trace:
#0 /return-type-hint-test/src/Callables/ObjectMethod.php(22): Interfaces\Delegate->process(Object(Zend\Diactoros\ServerRequest))
#1 {main}
  thrown in /return-type-hint-test/src/Callables/ObjectMethod.php on line 16

```

---

## src/Callables/RelativeStaticClassMethod.php

### Script

```php
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
```
### Output

```
PHP Fatal error:  Uncaught TypeError: Return value of Interfaces\DelegateA::process() must be an instance of Psr\Http\Message\ResponseInterface, integer returned in /return-type-hint-test/src/Callables/RelativeStaticClassMethod.php:16
Stack trace:
#0 [internal function]: Interfaces\DelegateA::process(Object(Zend\Diactoros\ServerRequest))
#1 /return-type-hint-test/src/Callables/RelativeStaticClassMethod.php(30): call_user_func(Array, Object(Zend\Diactoros\ServerRequest))
#2 {main}
  thrown in /return-type-hint-test/src/Callables/RelativeStaticClassMethod.php on line 16

```

---

## src/Callables/StaticMethod.php

### Script

```php
class Delegate
{
    public static function process(RequestInterface $request) : ResponseInterface
    {
        return 42;
    }
}

$delegate = 'Interfaces\Delegate::process';

var_dump($delegate(new \Zend\Diactoros\ServerRequest()));
```
### Output

```
PHP Fatal error:  Uncaught TypeError: Return value of Interfaces\Delegate::process() must be an instance of Psr\Http\Message\ResponseInterface, integer returned in /return-type-hint-test/src/Callables/StaticMethod.php:16
Stack trace:
#0 /return-type-hint-test/src/Callables/StaticMethod.php(22): Interfaces\Delegate::process(Object(Zend\Diactoros\ServerRequest))
#1 {main}
  thrown in /return-type-hint-test/src/Callables/StaticMethod.php on line 16

```

---

## src/Callables/StaticMethod2.php

### Script

```php
class Delegate
{
    public static function process(RequestInterface $request) : ResponseInterface
    {
        return 42;
    }
}

$delegate = ['Interfaces\Delegate', 'process'];

var_dump($delegate(new \Zend\Diactoros\ServerRequest()));
```
### Output

```
PHP Fatal error:  Uncaught TypeError: Return value of Interfaces\Delegate::process() must be an instance of Psr\Http\Message\ResponseInterface, integer returned in /return-type-hint-test/src/Callables/StaticMethod2.php:16
Stack trace:
#0 /return-type-hint-test/src/Callables/StaticMethod2.php(22): Interfaces\Delegate::process(Object(Zend\Diactoros\ServerRequest))
#1 {main}
  thrown in /return-type-hint-test/src/Callables/StaticMethod2.php on line 16

```

---

## src/Interfaces/AnonymousDelegateClass.php

### Script

```php
$delegate = new class implements DelegateInterface {
    function process(RequestInterface $request) : ResponseInterface
    {
        return 42;
    }
};

var_dump($delegate->process(new \Zend\Diactoros\ServerRequest()));
```
### Output

```
PHP Fatal error:  Uncaught TypeError: Return value of class@anonymous::process() must be an instance of Psr\Http\Message\ResponseInterface, integer returned in /return-type-hint-test/src/Interfaces/AnonymousDelegateClass.php:15
Stack trace:
#0 /return-type-hint-test/src/Interfaces/AnonymousDelegateClass.php(19): class@anonymous->process(Object(Zend\Diactoros\ServerRequest))
#1 {main}
  thrown in /return-type-hint-test/src/Interfaces/AnonymousDelegateClass.php on line 15

```

---

## src/Interfaces/DelegateClass.php

### Script

```php
class DelegateClass implements DelegateInterface
{
    function process(RequestInterface $request) : ResponseInterface
    {
        return 42;
    }
}

$delegate = new DelegateClass();

var_dump($delegate->process(new \Zend\Diactoros\ServerRequest()));
```
### Output

```
PHP Fatal error:  Uncaught TypeError: Return value of Interfaces\DelegateClass::process() must be an instance of Psr\Http\Message\ResponseInterface, integer returned in /return-type-hint-test/src/Interfaces/DelegateClass.php:16
Stack trace:
#0 /return-type-hint-test/src/Interfaces/DelegateClass.php(22): Interfaces\DelegateClass->process(Object(Zend\Diactoros\ServerRequest))
#1 {main}
  thrown in /return-type-hint-test/src/Interfaces/DelegateClass.php on line 16

```
