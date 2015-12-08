<?php
namespace Hal\Component\BusinessRule;

/*
 * (c) Jean-François Lépine <https://twitter.com/Halleck45>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Hal\Component\OOP\Reflected\ReflectedMethod;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class Evaluator {

    /**
     * Business rule engine
     * Usage:
     *  BRE('x > 5', ['x' => 6]
     *  BRE('x => x > 5', 6]
     *
     *
     * @param string $expression
     * @param array $variables
     * @return mixed
     */
    public function evaluate($expression, $variables)
    {
        if(preg_match('!^(.*?)\s=>\s*!', $expression, $m)) {
            list(, $varname) = $m;
            $variables = [$varname => $variables];
            $expression = preg_replace('!(^.*\s=>\s*)!', '', $expression);
        }
        $language = new ExpressionLanguage();
        $this->hydrates($language);
        return $language->evaluate($expression, $variables);
    }

    private function hydrates(ExpressionLanguage $language)
    {
        $language->register('count', function ($value) {
            return sprintf('(is_array(%1$s) ? sizeof(%1$s) : 0)', $value);
        }, function ($arguments, $value) {
            if (!is_array($value)) {
                return 0;
            }

            return sizeof($value);
        });

        $language->register('isMagicMethod', function ($value) {
            return sprintf('(strpos(%1$s, "__") === 0 ', $value);
        }, function ($arguments, $value) {
            if (!$value instanceof ReflectedMethod) {
                return false;
            }
            return strpos($value->getName(), "__") === 0;
        });
    }
}