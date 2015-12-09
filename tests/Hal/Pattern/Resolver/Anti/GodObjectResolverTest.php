<?php
namespace Test\Hal\Pattern\Resolver\Structural;


use Hal\Component\OOP\Extractor\Extractor;
use Hal\Component\Token\Tokenizer;
use Hal\Pattern\Resolver\Anti\GodObject\GodObjectResolver;
use Hal\Pattern\Resolver\Micro\Structure\StructureResolver;
use Hal\Pattern\Resolver\ResolvedClass;
use Hal\Pattern\Resolver\Structural\Proxy\ProxyResolver;

class GodObjectResolverTest extends \PHPUnit_Framework_TestCase {


    public function testGodObjectIsDetected() {

        $filename = __DIR__.'/../../../../resources/patterns/godobject.php';
        $extractor = new Extractor(new Tokenizer());
        $result = $extractor->extract($filename);
        $classes = $result->getClasses();

        $resolver = new GodObjectResolver($classes);


        $resolved = new ResolvedClass($classes[0]);
        $resolver->resolve($resolved);
        $this->assertEquals(1, sizeof($resolved->getPatterns()));

        $resolved = new ResolvedClass($classes[1]);
        $resolver->resolve($resolved);
        $this->assertEquals(0, sizeof($resolved->getPatterns()));
    }
}