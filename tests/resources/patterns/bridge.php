<?php
interface Implementation {
}
class MyImplementationA implements Implementation {}

abstract class Abstraction {
}
class MyRealization1 extends Abstraction {

    private $impl;
    public function __construct(Implementation $usedImplementation) {
        $this->impl = $usedImplementation;
    }

    public function doAny()
    {
        $this->impl->foo();
    }
}


class MyBridge {
    public function foo() {
        $c = new MyRealization1(new MyImplementationA());
        $c->doAny();
    }
}