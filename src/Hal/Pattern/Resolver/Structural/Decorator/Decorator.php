<?php
/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hal\Pattern\Resolver\Structural\Decorator;

use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Pattern\DesignPattern;
use Hal\Pattern\DesignPatternAbstract;
use Hal\Pattern\Resolver\PatternResolver;
use Hal\Pattern\Resolver\ResolvedClass;

class Decorator extends DesignPatternAbstract implements DesignPattern {

    /**
     * @var string
     */
    private $decorated;

    /**
     * @inheritdoc
     */
    public function getName() {
        return 'Decorator';
    }

    /**
     * @return string
     */
    public function describe() {
        return sprintf('%s is a Decorator. Decorated class: %s', $this->getMainClass(), $this->getDecorated());
    }

    /**
     * @return string
     */
    public function getDecorated()
    {
        return $this->decorated;
    }

    /**
     * @param string $decorated
     */
    public function setDecorated($decorated)
    {
        $this->decorated = $decorated;
    }

}