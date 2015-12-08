<?php

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hal\Pattern\Resolver\Queue;
use Hal\Pattern\Resolver\ResolvedClass;
use Hal\Pattern\Resolver\Resolver;

/**
 * Template sequence
 *
 * @author Jean-François Lépine <https://twitter.com/Halleck45>
 */
class Queue implements Resolver
{

    /**
     * Jobs
     *
     * @var \SplQueue
     */
    private $jobs;

    /**
     * Constructor
     */
    public function __construct() {
        $this->jobs = new \SplQueue();
    }

    /**
     * @param Resolver $command
     * @return $this
     */
    public function push(Resolver $command) {
        $this->jobs->push($command);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function resolve(ResolvedClass $class) {
        foreach($this->jobs as $job) {
            $job->resolve($class);
        }
    }

}
