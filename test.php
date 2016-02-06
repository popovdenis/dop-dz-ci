<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 30.01.2016
 * Time: 16:24
 */
class PersonTest extends PHPUnit_Framework_TestCase
{
    public function testPushAndPop()
    {
        $stack = array();
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertEquals(1, count($stack));

        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    }

    /**
     * @depends testPushAndPop
     */
    public function testSum()
    {
        $a = 2;
        $b = 2;
        $this->assertEquals($a, $b);
    }

    public function getProvider()
    {
        return array(
            array(0, 0, 0),
            array(0, 1, 1),
            array(1, 0, 1),
            array(1, 1, 3),
        );
    }

    /**
     * @param $a
     * @param $b
     * @param $c
     *
     * @dataProvider getProvider
     */
    public function testAdd($a, $b, $c)
    {
        $this->assertEquals($c, $a + $b);
    }
}