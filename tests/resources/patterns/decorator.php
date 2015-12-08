<?php

interface Decorated {}

abstract class Decorator {
    abstract public function decorate(Decorated $what);
}

class MyDecorator extends Decorator {

    public function decorate(Decorated $what)
    {
        return $what->foo().'baz';
    }
}