<?php
namespace My;

class A {

}

class B {

}

class MyBadFacade {
    public function foo()
    {
        $a = new A;
        $a->foo();

        $b = new Boo;
        $b->foo();



        $c = new Clo;
        $c->foo();
    }
}