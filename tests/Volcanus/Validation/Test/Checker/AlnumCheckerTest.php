<?php
/**
 * Volcanus libraries for PHP
 *
 * @copyright k-holy <k.holy74@gmail.com>
 * @license The MIT License (MIT)
 */

namespace Volcanus\Validation\Test\Checker;

use Volcanus\Validation\Checker\AlnumChecker;

/**
 * AlnumCheckerTest
 *
 * @author k.holy74@gmail.com
 */
class AlnumCheckerTest extends \PHPUnit\Framework\TestCase
{

    /** @var  \Volcanus\Validation\Checker\AlnumChecker */
    protected $checker;

    public function setUp()
    {
        $this->checker = new AlnumChecker();
    }

    public function testCheckIsOk()
    {
        $this->assertTrue($this->checker->check('ABC123'));
    }

    /**
     * @expectedException \Volcanus\Validation\Exception\CheckerException\AlnumException
     */
    public function testRaiseAlnumExceptionWhenCheckIsNgByFormat()
    {
        $this->checker->check('+123.45');
    }

    /**
     * @expectedException \Volcanus\Validation\Exception\CheckerException\AlnumException
     */
    public function testInvokeMethod()
    {
        $checker = $this->checker;
        $checker('+123.45');
    }

}
