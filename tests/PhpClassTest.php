<?php

namespace PhpCodeMakerTest;

use PhpCodeMaker\PhpClass;
use PhpCodeMaker\PhpClass\Method;

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

    public function testRender_successRenderNamespace_returnString()
    {
        $phpClass = new PhpClass;
        $phpClass->setName('User');
        $phpClass->setNamespace('\PhpCode');

        $string = $phpClass->render();

        $this->assertContains('namespace \PhpCode', $string);
    }

    public function testRender_successRenderUses_returnString()
    {
        $phpClass = new PhpClass;
        $phpClass
            ->setName('User')
            ->addUse('\PhpCode\Foo')
            ->addUse('\PhpCode\Bar');

        $string = $phpClass->render();

        $this->assertContains('use \PhpCode\Foo', $string);
        $this->assertContains('use \PhpCode\Bar', $string);
    }

    public function testRender_successRenderProperty_returnString()
    {
        $phpClass = new PhpClass;
        $phpClass->setName('User');
        $phpClass->makePublicProperty('lastName');

        $string = $phpClass->render();

        $this->assertContains('public $lastName', $string);
    }

    public function testRender_successRenderMethod_returnString()
    {
        $phpClass = new PhpClass;
        $phpClass->setName('User');
        $method = new Method;
        $code = <<<'PHP'
return $this->lastName . ' ' . $this->firstName;
PHP;
        $method
            ->setVisiblityPrivate()
            ->setName('getName')
            ->setCode($code);
        $phpClass->addMethod($method);

        $string = $phpClass->render();

        $this->assertContains('private function getName', $string);
    }

    public function testRender_hasInheritsClass_returnString()
    {
        $phpClass = new PhpClass;
        $phpClass->setName('User');
        $phpClass->setInherits('Human');

        $string = $phpClass->render();

        $this->assertContains(' extends Human', $string);
    }
    public function testRender_hasImplementsClasses_returnString()
    {
        $phpClass = new PhpClass;
        $phpClass->setName('User');
        $phpClass->setInherits('Human');
        $phpClass->setImplements(['Walking', 'Speak']);

        $string = $phpClass->render();

        $this->assertContains(' implements Walking, Speak', $string);
    }
}
