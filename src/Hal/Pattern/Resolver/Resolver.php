<?php
namespace Hal\Pattern\Resolver;

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Hal\Component\OOP\Reflected\ReflectedClass;
use Hal\Pattern\Resolver\ResolvedClass;

interface Resolver {

    public function resolve(ResolvedClass $class);
}