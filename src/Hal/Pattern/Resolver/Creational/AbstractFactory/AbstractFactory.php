<?php
/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hal\Pattern\Resolver\Creational\AbstractFactory;

use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Pattern\DesignPattern;
use Hal\Pattern\DesignPatternAbstract;
use Hal\Pattern\Resolver\PatternResolver;
use Hal\Pattern\Resolver\ResolvedClass;

class AbstractFactory extends DesignPatternAbstract implements DesignPattern {

    /**
     * @var strings
     */
    private $created;

    /**
     * @inheritdoc
     */
    public function getName() {
        return 'Abstract Factory';
    }

    /**
     * @return string
     */
    public function describe() {
        return sprintf('%s is an Abstract Factory of %s', $this->getMainClass(), $this->getCreated());
    }

    /**
     * @return strings
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param strings $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }



}