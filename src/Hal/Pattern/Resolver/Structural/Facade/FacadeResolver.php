<?php
namespace Hal\Pattern\Resolver\Structural\Facade;

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Pattern\Resolver\PatternResolver;
use Hal\Pattern\Resolver\ResolvedClass;

class FacadeResolver extends PatternResolver {

    /**
     * Resolve facades
     *
     *      Call lot of non instancied external classes
     *
     * @param ResolvedClass $resolved
     */
    public function resolve(ResolvedClass $resolved) {

        $class = $resolved->getClass();
        $pattern = new Facade($class->getFullname());

        foreach($class->getMethods() as $method) {

            $instancied = array_unique($method->getInstanciedClasses());
            // $externalCalls = $method->getExternalCalls();
            // today PhpMetrics is not able to get external calls when they are made on internal propery
            // ex: $this->foo->bar()
            // we will count T_OBJECT_CALL
            if(preg_match_all('!\->\w+\(!', $method->getTokens()->asString(), $matches)) {
                $nbExternalCalls = sizeof($matches[0]);
            }

            if(sizeof($instancied) == 0 &&$nbExternalCalls >= 2) {
                $resolved->pushPattern($pattern);
                return;
            }
        }
    }
}