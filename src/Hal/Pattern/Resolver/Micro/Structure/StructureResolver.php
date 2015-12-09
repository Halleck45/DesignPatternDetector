<?php
namespace Hal\Pattern\Resolver\Micro\Structure;

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

class StructureResolver extends PatternResolver {

    /**
     * Resolve Structures
     *
     *      extends nothing
     *      has only getter and setters
     *
     * @param ResolvedClass $resolved
     */
    public function resolve(ResolvedClass $resolved) {

        $class = $resolved->getClass();
        $pattern = new Structure($class->getFullname());

        // extends one class
        if($class->getParent()) {
            return;
        }

        // we don't look private methods
        $collection1 = (new Collection($class->getMethods()))->where('method => method.getVisibility() == "public"');

        // at least 2 public methods
        if(sizeof($collection1) < 2) {
            return;
        }

        // list getters and setters
        $collection2 = (new Collection($class->getMethods()))->where('method => (method.isGetter() or method.isSetter()) and method.getVisibility() == "public"');

        if(sizeof($collection1) === sizeof($collection2)) {
            $resolved->pushPattern($pattern);
        }
    }
}