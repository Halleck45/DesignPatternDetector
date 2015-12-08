<?php
namespace Test\Hal\Pattern\Resolver\Structural;


use Hal\Component\OOP\Extractor\Extractor;
use Hal\Component\Token\Tokenizer;
use Hal\Pattern\Resolver\ResolvedClass;
use Hal\Pattern\Resolver\Structural\Proxy\ProxyResolver;

class ProxyResolverTest extends \PHPUnit_Framework_TestCase {


    public function testProxyIsDetected() {

        $filename = __DIR__.'/../../../../resources/patterns/proxy.php';
        $extractor = new Extractor(new Tokenizer());
        $result = $extractor->extract($filename);
        $classes = $result->getClasses();
        $class = $classes[2];

        $resolved = new ResolvedClass($class);
        $resolver = new ProxyResolver($classes);
        $resolver->resolve($resolved);
        $this->assertEquals(1, sizeof($resolved->getPatterns()));
    }
}