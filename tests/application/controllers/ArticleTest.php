<?php
require_once("RemoteConnect.php");
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 06.02.2016
 * Time: 12:33
 */
class ArticleTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function tearDown()
    {

    }

    public function testAdd()
    {
        $this->assertEquals(1, 1);
    }

    public function testConnectionIsValid()
    {
        // проверка валидности соединения с сервером
        $connObj = new RemoteConnect();
        $serverName = 'www.google.com';
        $this->assertTrue($connObj->connectToServer($serverName) !== false);
    }
}
