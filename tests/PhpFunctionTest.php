<?php

namespace PhpCodeMakerTest;

use PhpCodeMaker\PhpFunction;


class PhpFunctionTest extends \PHPUnit\Framework\TestCase
{
    public function testRender_withoutParams_returnString()
    {
        $phpFunction = new PhpFunction;
        $phpFunction
            ->setName('test')
            ->setDescription('Description for test function');

        $string = $phpFunction->render();

        $this->assertContains('function test', $string);
    }

    public function testRender_withParams_returnString()
    {
        $phpFunction = new PhpFunction;
        $phpFunction
            ->setName('test')
            ->makeParam('user', 'User');

        $string = $phpFunction->render();

        $this->assertContains('User $user', $string);
        $this->assertContains('* @param User $user', $string);
    }
}
