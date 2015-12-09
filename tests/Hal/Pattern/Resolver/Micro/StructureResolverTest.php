<?php
namespace Test\Hal\Pattern\Resolver\Structural;


use Hal\Component\OOP\Extractor\Extractor;
use Hal\Component\Token\Tokenizer;
use Hal\Pattern\Resolver\Micro\Structure\StructureResolver;
use Hal\Pattern\Resolver\ResolvedClass;
use Hal\Pattern\Resolver\Structural\Proxy\ProxyResolver;

class StructureResolverTest extends \PHPUnit_Framework_TestCase {


    public function testStructureIsDetected() {

        $filename = __DIR__.'/../../../../resources/patterns/structure.php';
        $extractor = new Extractor(new Tokenizer());
        $result = $extractor->extract($filename);
        $classes = $result->getClasses();

        $resolver = new StructureResolver($classes);


        $resolved = new ResolvedClass($classes[0]);
        $resolver->resolve($resolved);
        $this->assertEquals(1, sizeof($resolved->getPatterns()));

        $resolved = new ResolvedClass($classes[1]);
        $resolver->resolve($resolved);
        $this->assertEquals(0, sizeof($resolved->getPatterns()));
    }
}