<?php
namespace Hal\Pattern\Resolver\Structural\Proxy;

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Pattern\Resolver\PatternResolver;
use Hal\Pattern\Resolver\ResolvedClass;

class ProxyResolver extends PatternResolver {

    /**
     * Resolve proxies
     *
     *      A class implements an interface or extends
     *      an (abstract) class, and owns a
     *      reference to a class that implements the
     *      same interface or extends the same (abstract)
     *      class.
     *
     * @param ResolvedClass $resolved
     */
    public function resolve(ResolvedClass $resolved) {

        $class = $resolved->getClass();
        $pattern = new Proxy($class->getFullname());

        if($class->getParent() ||$class->getInterfaces()) {
            $deps = $class->getDependencies();
            foreach($deps as $dep) {

                // does call any class ?
                $dep = $this->searchClassNamed($dep, $this->classes);
                if(!$dep ||$dep->getFullname() === $class->getFullname()) {
                    continue;
                }

                // same parent ?
                $sameKind = null !== $dep->getParent() && $dep->getParent() === $class->getParent();

                // same interface ?
                $sameKind = $sameKind || sizeof(array_intersect($class->getInterfaces(), $dep->getInterfaces())) > 0;

                if($sameKind) {
                    $pattern->setProxified($dep->getFullname());
                    $resolved->pushPattern($pattern);
                    return;
                }
            }
        }

    }
}