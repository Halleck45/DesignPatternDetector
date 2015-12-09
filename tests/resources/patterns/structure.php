<?php
namespace My;

class EntityOne{
    private $a;
    private $b;
    private $c;

    public function getA()
    {
        return $this->a;
    }

    public function setA($a)
    {
        $this->a = $a;
        return $this;
    }

    public function getB()
    {
        return $this->b;
    }

    public function setB($b)
    {
        $this->b = $b;
        return $this;
    }

    public function getC()
    {
        return $this->c;
    }

    public function setC($c)
    {
        $this->c = $c;
        return $this;
    }

}

class Service {
    public function foo() {
        return new EntityOne();
    }
}