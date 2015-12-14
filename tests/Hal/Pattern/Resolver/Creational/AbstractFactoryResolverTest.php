<?php
namespace Test\Hal\Pattern\Resolver\Structural;


use Hal\Component\OOP\Extractor\Extractor;
use Hal\Component\Token\Tokenizer;
use Hal\Pattern\Resolver\Creational\AbstractFactory\AbstractFactoryResolver;
use Hal\Pattern\Resolver\ResolvedClass;
use Hal\Pattern\Resolver\Structural\Proxy\ProxyResolver;

class AbstractFactoryResolverTest extends \PHPUnit_Framework_TestCase {


    public function testAbstractFactoryIsDetected() {

        $filename = __DIR__.'/../../../../resources/patterns/abstract-factory.php';
        $extractor = new Extractor(new Tokenizer());
        $result = $extractor->extract($filename);
        $classes = $result->getClasses();
        $class = $classes[1];

        $resolved = new ResolvedClass($class);
        $resolver = new AbstractFactoryResolver($classes);
        $resolver->resolve($resolved);
        $this->assertEquals(1, sizeof($resolved->getPatterns()));
    }
}