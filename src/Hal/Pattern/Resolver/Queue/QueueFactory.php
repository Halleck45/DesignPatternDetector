<?php

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hal\Pattern\Resolver\Queue;
use Hal\Pattern\Resolver\Anti\GodObject\GodObjectResolver;
use Hal\Pattern\Resolver\Creational\AbstractFactory\AbstractFactoryResolver;
use Hal\Pattern\Resolver\Creational\Singleton\SingletonResolver;
use Hal\Pattern\Resolver\Micro\Structure\StructureResolver;
use Hal\Pattern\Resolver\Structural\Bridge\BridgeResolver;
use Hal\Pattern\Resolver\Structural\Decorator\DecoratorResolver;
use Hal\Pattern\Resolver\Structural\Facade\FacadeResolver;
use Hal\Pattern\Resolver\Structural\Proxy\ProxyResolver;

/**
 * Queue factory
 *
 * @author Jean-François Lépine <https://twitter.com/Halleck45>
 */
class QueueFactory
{

    /**
     * @var array
     */
    private $classes;

    /**
     * @param array $classes
     */
    public function __construct(array $classes)
    {
        $this->classes = $classes;
    }

    /**
     * @return Queue[]
     */
    public function factory() {
        $queue = new Queue;
        $queue
            ->push(new ProxyResolver($this->classes))
            ->push(new SingletonResolver($this->classes))
            ->push(new BridgeResolver($this->classes))
            //->push(new FacadeResolver($this->classes)) FacadeResolver doesn't work
            ->push(new DecoratorResolver($this->classes))
            ->push(new StructureResolver($this->classes))
            ->push(new GodObjectResolver($this->classes))
            ->push(new AbstractFactoryResolver($this->classes))
        ;
        return $queue;
    }

}
