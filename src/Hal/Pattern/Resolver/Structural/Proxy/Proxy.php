<?php
/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hal\Pattern\Resolver\Structural\Proxy;

use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Pattern\DesignPattern;
use Hal\Pattern\DesignPatternAbstract;
use Hal\Pattern\Resolver\PatternResolver;
use Hal\Pattern\Resolver\ResolvedClass;

class Proxy extends DesignPatternAbstract implements DesignPattern {

    /**
     * @var string
     */
    private $proxified;

    /**
     * @inheritdoc
     */
    public function getName() {
        return 'Proxy';
    }

    /**
     * @return string
     */
    public function getProxified()
    {
        return $this->proxified;
    }

    /**
     * @param string $proxified
     * @return Proxy
     */
    public function setProxified($proxified)
    {
        $this->proxified = $proxified;
        return $this;
    }

    /**
     * @return string
     */
    public function describe() {
        return sprintf('%s is a proxy of %s', $this->getMainClass(), $this->getProxified());
    }

}