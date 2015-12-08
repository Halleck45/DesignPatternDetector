<?php
namespace Hal\Pattern\Resolver\Structural\Bridge;

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Component\OOP\Reflected\ReflectedInterface;
use Hal\Pattern\Resolver\PatternResolver;
use Hal\Pattern\Resolver\ResolvedClass;

class BridgeResolver extends PatternResolver {

    /**
     * Resolve bridges
     *
     *      Bridge is identified by its Abstraction class, which
     *      manages a number of Implementors and has some realization as RefinedAbstraction. Each
     *      Implementor has some realization.
     *
     * @param ResolvedClass $resolved
     */
    public function resolve(ResolvedClass $resolved) {

        $class = $resolved->getClass();
        $pattern = new Bridge($class->getFullname());

        // uses more than 2 classes ?
        $deps = $class->getDependencies();
        if(sizeof($deps) < 1) {
            return;
        }

        // preparing data
        // only for algorithm
        $map = [];
        foreach($deps as $index => $dep) {
            $dep = $this->searchClassNamed($dep, $this->classes);
            if (!$dep || $dep->getFullname() === $class->getFullname()) {
                continue;
            }

            $map[$dep->getFullname()] = $dep;
        }

        // uses a class (abstraction) that itslef uses another that main class uses (implementation) ?
        foreach($map as $dep) {

            // get dependencies of this dependency
            $relatedDeps = $dep->getDependencies();
            foreach($relatedDeps as $relatedDep) {
                $relatedDep = $this->searchClassNamed($relatedDep, $this->classes);
                if (!$relatedDep || $relatedDep->getFullname() === $class->getFullname()) {
                    continue;
                }

                // does this related dependencies is also used by main dependency ?
                if(isset($map[$relatedDep->getFullname()]) && $dep->getFullname() !== $relatedDep->getFullname()) {

                    $pattern->setAbstractness($dep->getFullname());
                    $pattern->setImplemenation($relatedDep->getFullname());

                    $resolved->pushPattern($pattern);
                    return;
                }
            }
        }

    }
}