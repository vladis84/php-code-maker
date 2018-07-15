<?php

namespace PhpCodeMakerTest\PhpClass;

use PhpCodeMaker\PhpClass\Property;

class PropertyTest extends \PHPUnit_Framework_TestCase
{
    public function testRender_successRender_returnString()
    {
        $property = new Property();
        $property->setName('user');
        $property->addPhpDoc('@var', 'User');

        $string = $property->render();

        $this->assertContains('* @var User', $string);
        $this->assertContains('public $user;', $string);
    }
}
