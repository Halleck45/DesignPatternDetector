<?php
namespace Hal\Pattern\Resolver\Anti\GodObject;

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
use Hal\Metrics\Complexity\Structural\LCOM\LackOfCohesionOfMethods;
use Hal\Pattern\Resolver\PatternResolver;
use Hal\Pattern\Resolver\ResolvedClass;

class GodObjectResolver extends PatternResolver {

    /**
     * Resolve GodObjects
     *
     *      8 public methods or more (excluding getters and setters)
     *      lack of cohesion of methods
     *      instanciate 6 or more different classes
     *
     * @param ResolvedClass $resolved
     */
    public function resolve(ResolvedClass $resolved) {

        $class = $resolved->getClass();
        $pattern = new GodObject($class->getFullname());


        // we don't look private methods
        $collection = (new Collection($class->getMethods()))->where('method => method.getVisibility() == "public"');

        // at least 8 public methods
        if(sizeof($collection) < 8) {
            return;
        }
        // lack of cohesion of methods
        $lcom = new LackOfCohesionOfMethods();
        $result = $lcom->calculate($class);
        if($result->getLcom() < 3) {
            return;
        }

        // know everything (instanciate more than 8 different classes)
        $nb = 0;
        foreach($collection as $method) {
            $nb += sizeof(array_unique($method->getInstanciedClasses()));
        }
        if($nb < 6) {
            return;
        }

        $resolved->pushPattern($pattern);
    }
}