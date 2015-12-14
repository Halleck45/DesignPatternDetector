<?php
namespace Hal\Pattern\Resolver\Creational\AbstractFactory;

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Hal\Component\BusinessRule\Collection;
use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Component\OOP\Reflected\ReflectedMethod;
use Hal\Component\OOP\Reflected\ReflectedReturn;
use Hal\Component\OOP\Resolver\TypeResolver;
use Hal\Pattern\Resolver\PatternResolver;
use Hal\Pattern\Resolver\ResolvedClass;

class AbstractFactoryResolver extends PatternResolver {

    /**
     * Resolve AbstractFactory
     *
     * @param ResolvedClass $resolved
     */
    public function resolve(ResolvedClass $resolved) {

        $class = $resolved->getClass();
        $pattern = new AbstractFactory($class->getFullname());
        $resolver = new TypeResolver();

        // we don't look private and non static methods
        $collection = (new Collection($class->getMethods()))->where(sprintf('method => method.getVisibility() == "public" and method.getState() == %s', ReflectedMethod::STATE_STATIC));
        if(empty($collection)) {
            return;
        }


        /** @var ReflectedMethod $method */
        foreach($collection as $method) {
            // method instanciates at least one object
            $instanciated = array_unique($method->getInstanciedClasses());

            if(empty($instanciated)) {
                continue;
            }

            foreach($method->getReturns() as $return) {

                // returns an object
                if($resolver->isNative($return->getType())) {
                    continue;
                }

                // doesn't return itself (avoid singleton)
                if(in_array($return->getType(), array('\\self', '\\static', $class->getFullname()))) {
                    continue;
                }

                $pattern->setCreated($return->getType());
                $resolved->pushPattern($pattern);
                return;

            }
        }
    }
}