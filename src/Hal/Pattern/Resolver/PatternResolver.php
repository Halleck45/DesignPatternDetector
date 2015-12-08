<?php
namespace Hal\Pattern\Resolver;

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Hal\Pattern\Resolver\Queue\Queue;
use Hal\Pattern\Resolver\Queue\QueueFactory;

class PatternResolver implements Resolver {

    /**
     * @var array
     */
    protected $classes;

    /**
     * Resolver constructor.
     * @param array $classes
     */
    public function __construct(array $classes)
    {
        $this->classes = $classes;
    }

    public function resolve(ResolvedClass $class) {
        $queue = (new QueueFactory($this->classes))->factory();
        $queue->resolve($class);
    }

    protected function searchClassNamed($name, $classes) {
        foreach($classes as $c) {
            if($c->getFullname() === $name) {
                return $c;
            }
        }
        return null;
    }
}