<?php
namespace Test\Hal\BusinessRule;

use Hal\Component\BusinessRule\Evaluator;

class EvaluatorTest extends \PHPUnit_Framework_TestCase {
    /**
     * @dataProvider provideValidValues
     */
    public function testRuleIsEvaluated($expected, $expression) {
        $evaluator = new Evaluator();

        $user = (object) array(
            'age' => 25,
            'money' => 400,
        );

        $result = $evaluator->evaluate($expression, array('user' => $user));
        $this->assertEquals($expected, $result);
    }
    public function provideValidValues() {
        return array(
            array(true,'user.money > 300')
        , array(false,'user.money < 300')
        , array(true,'user.money > 300 and user.age > 18')
        , array(false,'user.money > 300 and user.age < 18')
        );
    }
    public function testICanUseShortExpressionToGiveVariables() {
        $evaluator = new Evaluator();

        $user = (object) array(
            'age' => 25,
            'money' => 400,
        );

        $result = $evaluator->evaluate('user => user.age > 18', $user);
        $this->assertEquals(true, $result);
    }
}
