<?php
namespace Hal\Pattern\Resolver\Creational\Singleton;

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Component\OOP\Reflected\ReflectedMethod;
use Hal\Pattern\Resolver\PatternResolver;
use Hal\Pattern\Resolver\ResolvedClass;

class SingletonResolver extends PatternResolver {

    /**
     * Resolve Singleton
     *
     * @param ResolvedClass $resolved
     */
    public function resolve(ResolvedClass $resolved) {

        $class = $resolved->getClass();
        $pattern = new Singleton($class->getFullname());
        $methods = $class->getMethods();

        // private construct ?
        if(isset($methods['__construct']) && $methods['__construct']->getVisibility() !== ReflectedMethod::VISIBILITY_PUBLIC) {

            // static method ?
            foreach($methods as $method) {
                if($method->getState() === ReflectedMethod::STATE_STATIC) {

                    // call itself ?
                    $deps = $method->getReturns();
                    foreach($deps as $dep) {
                        if(in_array($dep->getType(), array('\\self', '\\static', $class->getFullname()))) {

                            // yes, class is a singleton
                            $resolved->pushPattern($pattern);
                            return;
                        }
                    }
                }
            }
        }
    }
}