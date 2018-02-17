<?php

namespace ClassGenTest;

use ClassGen\PhpClass;

/**
 *
 */
class PhpClassTest extends \PHPUnit\Framework\TestCase
{
    public function testRender_successRender_returnString()
    {
        $phpClass = new PhpClass;
        $phpClass
            ->setName('User')
            ->setDescription('Description for');

        $string = $phpClass->render();

        $this->assertContains('User', $string);
    }

    public function testRender_successRenderProperty_returnString()
    {
        $phpClass = new PhpClass;
        $phpClass->setName('User');
        $phpClass->makePublicProperty('lastName');

        $string = $phpClass->render();

        $this->assertContains('public $lastName', $string);
    }
}
