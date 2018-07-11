<?php

namespace PhpCodeMakerTest\PhpClass;

use PhpCodeMaker\PhpClass\Method;

/**
 *
 */
class MethodTest extends \PHPUnit\Framework\TestCase
{
    public function testRender__returnString()
    {
        $method = new Method;
        $method
            ->setName('test')
            ->setVisiblityPublic();

        $string = $method->render();

        $this->assertContains('public function test', $string);
    }
}
