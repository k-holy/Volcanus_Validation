<?php
/**
 * Volcanus libraries for PHP
 *
 * @copyright k-holy <k.holy74@gmail.com>
 * @license The MIT License (MIT)
 */

namespace Volcanus\Validation\Test\Checker;

use Volcanus\Validation\Checker\MaxLengthChecker;

/**
 * MaxLengthCheckerTest
 *
 * @author k.holy74@gmail.com
 */
class MaxLengthCheckerTest extends \PHPUnit\Framework\TestCase
{

    /** @var  \Volcanus\Validation\Checker\MaxLengthChecker */
    protected $checker;

    public function setUp()
    {
        $this->checker = new MaxLengthChecker();
        $this->checker->setOption('encoding', 'UTF-8');
        $this->checker->setOption('mbLength', MaxLengthChecker::LENGTH_CHARS);
    }

    public function testCheckIsOk()
    {
        $this->assertTrue($this->checker->check('1', ['length' => 1]));
    }

    public function testCheckIsOkWhenMultiByteCharactersLength()
    {
        $this->assertTrue($this->checker->check('ｱｲｳ', ['length' => 3]));
        $this->assertTrue($this->checker->check('アイウ', ['length' => 3]));
    }

    public function testCheckIsOkWhenMultiByteCharactersBytes()
    {
        $this->assertTrue($this->checker->check('ｱｲｳ', ['length' => 9, 'mbLength' => MaxLengthChecker::LENGTH_BYTES]));
        $this->assertTrue($this->checker->check('アイウ', ['length' => 9, 'mbLength' => MaxLengthChecker::LENGTH_BYTES]));
    }

    public function testCheckIsOkWhenMultiByteCharactersWidth()
    {
        $this->assertTrue($this->checker->check('ｱｲｳ', ['length' => 3, 'mbLength' => MaxLengthChecker::LENGTH_WIDTH]));
        $this->assertTrue($this->checker->check('アイウ', ['length' => 6, 'mbLength' => MaxLengthChecker::LENGTH_WIDTH]));
    }

    /**
     * @expectedException \Volcanus\Validation\Exception\CheckerException\MaxLengthException
     */
    public function testRaiseMaxLengthExceptionWhenHalfWidthedMultiByteCharactersLength()
    {
        $this->checker->check('ｱｲｳ', ['length' => 2]);
    }

    /**
     * @expectedException \Volcanus\Validation\Exception\CheckerException\MaxLengthException
     */
    public function testRaiseMaxLengthExceptionWhenFullWidthedMultiByteCharactersLength()
    {
        $this->checker->check('アイウ', ['length' => 2]);
    }

    /**
     * @expectedException \Volcanus\Validation\Exception\CheckerException\MaxLengthException
     */
    public function testRaiseMaxLengthExceptionWhenHalfWidthedMultiByteCharactersBytes()
    {
        $this->checker->check('ｱｲｳ', ['length' => 8, 'mbLength' => MaxLengthChecker::LENGTH_BYTES]);
    }

    /**
     * @expectedException \Volcanus\Validation\Exception\CheckerException\MaxLengthException
     */
    public function testRaiseMaxLengthExceptionWhenFullWidthedMultiByteCharactersBytes()
    {
        $this->checker->check('アイウ', ['length' => 8, 'mbLength' => MaxLengthChecker::LENGTH_BYTES]);
    }

    /**
     * @expectedException \Volcanus\Validation\Exception\CheckerException\MaxLengthException
     */
    public function testRaiseMaxLengthExceptionWhenHalfWidthedMultiByteCharactersWidth()
    {
        $this->checker->check('ｱｲｳ', ['length' => 2, 'mbLength' => MaxLengthChecker::LENGTH_WIDTH]);
    }

    /**
     * @expectedException \Volcanus\Validation\Exception\CheckerException\MaxLengthException
     */
    public function testRaiseMaxLengthExceptionWhenFullWidthedMultiByteCharactersWidth()
    {
        $this->checker->check('アイウ', ['length' => 5, 'mbLength' => MaxLengthChecker::LENGTH_WIDTH]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRaiseInvalidArgumentExceptionWhenLengthParameterIsNotSpecified()
    {
        $this->checker->check('123');
    }

    /**
     * @expectedException \Volcanus\Validation\Exception\CheckerException\MaxLengthException
     */
    public function testInvokeMethod()
    {
        $checker = $this->checker;
        $checker->setOption('length', 2);
        $checker('123');
    }

}
