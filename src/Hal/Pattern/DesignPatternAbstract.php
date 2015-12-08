<?php
namespace Hal\Pattern;

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Pattern\Resolver\ResolvedClass;

abstract class DesignPatternAbstract implements DesignPattern {

    /**
     * @var string
     */
    protected $mainClass;

    /**
     * DesignPatternAbstract constructor.
     * @param string $mainClass
     */
    public function __construct($mainClass)
    {
        $this->mainClass = $mainClass;
    }

    /**
     * @return string
     */
    public function getMainClass()
    {
        return $this->mainClass;
    }

}