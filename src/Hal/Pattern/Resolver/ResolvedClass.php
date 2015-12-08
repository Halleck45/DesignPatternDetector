<?php
namespace Hal\Pattern\Resolver;

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Pattern\DesignPattern;

class ResolvedClass {

    /**
     * @var ReflectedClass
     */
    private $class;

    /**
     * @var DesignPattern[]
     */
    private $patterns = [];

    /**
     * ResolvedClass constructor.
     * @param ReflectedClass $class
     */
    public function __construct(ReflectedClass $class)
    {
        $this->class = $class;
    }

    /**
     * @return ReflectedClass
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param DesignPattern $pattern
     * @return $this
     */
    public function pushPattern(DesignPattern $pattern) {
        $this->patterns[] = $pattern;
        return $this;
    }

    /**
     * @return array
     */
    public function getPatterns()
    {
        return $this->patterns;
    }
}