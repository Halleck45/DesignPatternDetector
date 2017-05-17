<?php

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hal\Application\Command;
use Hal\Application\Command\Job\QueueFactory;
use Hal\Application\Config\ConfigFactory;
use Hal\Component\Bounds\Bounds;
use Hal\Component\Evaluation\Evaluator;
use Hal\Component\File\Finder;
use Hal\Component\OOP\Reflected\ReflectedMethod;
use Hal\Pattern\Resolver\PatternResolver;
use Hal\Pattern\Resolver\ResolvedClass;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Hal\Application\Command\Job\Analyze\CardAndAgrestiAnalyzer;
use Hal\Application\Command\Job\Analyze\CouplingAnalyzer;
use Hal\Application\Command\Job\Analyze\FileAnalyzer;
use Hal\Application\Command\Job\Analyze\LcomAnalyzer;
use Hal\Component\Cache\CacheMemory;
use Hal\Component\File\SyntaxChecker;
use Hal\Component\OOP\Extractor\ClassMap;
use Hal\Component\OOP\Extractor\Extractor;
use Hal\Component\Result\ResultCollection;
use Hal\Component\Token\NoTokenizableException;
use Hal\Component\Token\Tokenizer;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Command for run analysis
 *
 * @author Jean-François Lépine <https://twitter.com/Halleck45>
 */
class RunPatternCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
                ->setName('patterns')
                ->setDescription('Run analysis')
                ->addArgument(
                    'path', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'Path to explore'
                )
                ->addOption(
                    'extensions', null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED, 'Regex of extensions to include', ['php']
                )
                ->addOption(
                    'excluded-dirs', null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED, 'Regex of subdirectories to exclude', ['Tests', 'tests', 'Features', 'features', '\.svn', '\.git', 'vendor']
                )
        ;
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln('Design pattern detector by Jean-François Lépine <https://twitter.com/Halleck45>');
        $output->writeln('');


        $finder = new Finder($input->getOption('extensions'), $input->getOption('excluded-dirs'));
        $files = $finder->fetch($input->getArgument('path'));

        if(0 == sizeof($files, COUNT_NORMAL)) {
            throw new \LogicException('No file found');
        }


        //
        // 1. Extracting classes
        $output->writeln('<info>Extracting classes</info>');
        $progress = new ProgressBar($output);
        $progress->start(sizeof($files, COUNT_NORMAL));

        $collection = array();
        $tokenizer = new Tokenizer(new CacheMemory());
        $extractor = new Extractor($tokenizer);
        $nbClasses = 0;
        foreach($files as $k => $filename) {
            $progress->advance();
            $collection[] = $classes = $extractor->extract($filename);
            $nbClasses += sizeof($classes->getClasses());
        }

        $progress->clear();
        $progress->finish();

        // inform user
        $output->writeln('');
        $output->writeln('');
        $output->writeln(sprintf("<info>Found %d classes</info>", $nbClasses));


        //
        // 2. Extracting patterns
        $output->writeln('<info>Extracting design patterns</info>');
        $patterns = array();
        foreach($collection as $oop) {
            $classes = $oop->getClasses();
            $resolver = new PatternResolver($classes);
            foreach($classes as $class) {
                $resolvedClass  = new ResolvedClass($class);
                $resolver->resolve($resolvedClass);
                if($resolvedClass->getPatterns()) {
                    $patterns = array_merge($patterns, $resolvedClass->getPatterns());
                }
            }
        }


        // inform user
        $output->writeln(sprintf("<info>Found %d design patterns</info>", sizeof($patterns)));


        foreach($patterns as $pattern) {
            $output->writeln(sprintf("\t<info>[%s]</info> %s", $pattern->getName(), $pattern->describe()));
        }
    }
}
