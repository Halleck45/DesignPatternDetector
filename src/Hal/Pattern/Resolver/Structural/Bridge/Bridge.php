<?php
/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hal\Pattern\Resolver\Structural\Bridge;

use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Pattern\DesignPattern;
use Hal\Pattern\DesignPatternAbstract;
use Hal\Pattern\Resolver\PatternResolver;
use Hal\Pattern\Resolver\ResolvedClass;

class Bridge extends DesignPatternAbstract implements DesignPattern {

    /**
     * @var string
     */
    private $abstractness;

    /**
     * @var string
     */
    private $implemenation;

    /**
     * @inheritdoc
     */
    public function getName() {
        return 'Bridge';
    }

    /**
     * @return string
     */
    public function describe() {
        return sprintf('%s is a Bridge. Abstraction: %s, Implementation: %s', $this->getMainClass(), $this->getAbstractness(), $this->getImplemenation());
    }

    /**
     * @return string
     */
    public function getAbstractness()
    {
        return $this->abstractness;
    }

    /**
     * @param string $abstractness
     * @return Bridge
     */
    public function setAbstractness($abstractness)
    {
        $this->abstractness = $abstractness;
        return $this;
    }

    /**
     * @return string
     */
    public function getImplemenation()
    {
        return $this->implemenation;
    }

    /**
     * @param string $implemenation
     * @return Bridge
     */
    public function setImplemenation($implemenation)
    {
        $this->implemenation = $implemenation;
        return $this;
    }



}