<?php
namespace Hal\Pattern\Resolver\Structural\Decorator;

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Hal\Component\BusinessRule\Collection;
use Hal\Component\BusinessRule\Evaluator;
use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Component\OOP\Reflected\ReflectedInterface;
use Hal\Pattern\Resolver\PatternResolver;
use Hal\Pattern\Resolver\ResolvedClass;

class DecoratorResolver extends PatternResolver {

    /**
     * Resolve Decorators
     *
     *      extends one class,
     *      has one public method
     *      receive one argument and call this argument
     *
     * @param ResolvedClass $resolved
     */
    public function resolve(ResolvedClass $resolved) {

        $class = $resolved->getClass();
        $pattern = new Decorator($class->getFullname());

        // extends one class
        if(!$class->getParent()) {
            return;
        }

        // exclude magical methods
        $collection = (new Collection($class->getMethods()))->where('method => !isMagicMethod(method)');

        // class should have only one public method
        $collection->where('method => method.getVisibility() == "public"');
        if(sizeof($collection) != 1) {
            return;
        }

        // receive one argument
        $collection->where('count(method.getArguments()) == 1');
        if(sizeof($collection) != 1) {
            return;
        }

        // call received argument
        $method = $collection->first();
        foreach($method->getArguments() as $argument) {
            if(in_array($argument->getName(), $method->getExternalCalls()) ){
                $pattern->setDecorated($argument->getType());
                $resolved->pushPattern($pattern);
                return;
            }
        }

    }
}