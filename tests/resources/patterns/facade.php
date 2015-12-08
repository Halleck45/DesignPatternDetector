<?php
namespace My;

class A {

}

class B {

}

class MyFacade {

    private $a;
    private $b;
    private $c;

    /**
     * MyFacade constructor.
     * @param $a
     * @param $b
     * @param $c
     */
    public function __construct($a, $b, $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }


    public function foo()
    {
        $this->a->foo();
        $this->b->foo();
    }

    public function bar()
    {
        $this->c->foo();
    }
}