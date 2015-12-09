<?php
/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hal\Pattern\Resolver\Anti\GodObject;

use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Pattern\DesignPattern;
use Hal\Pattern\DesignPatternAbstract;
use Hal\Pattern\Resolver\PatternResolver;
use Hal\Pattern\Resolver\ResolvedClass;

class GodObject extends DesignPatternAbstract implements DesignPattern {

    /**
     * @var string
     */
    private $decorated;

    /**
     * @inheritdoc
     */
    public function getName() {
        return 'GodObject';
    }

    /**
     * @return string
     */
    public function describe() {
        return sprintf('%s is a GodObject (also known as "Blob")', $this->getMainClass());
    }

}