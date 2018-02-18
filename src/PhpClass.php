<?php

namespace PhpCodeMaker;

use PhpCodeMaker\PhpClass\Method;
use PhpCodeMaker\PhpUse;

/**
 * класс
 */
class PhpClass extends Element
{
    /**
     * @var PhpNamespace 
     */
    private $namespace;

    /**
     * Список используемых классов/трайтов
     * @var PhpUse[]
     */
    private $uses = [];

    /**
     * Список свойств
     * @var PhpClass\Property[]
     */
    private $properties = [];

    /**
     * Список методов
     * @var Method[]
     */
    private $methods = [];

    public function setNamespace($namespace)
    {
        $phpNamespase = new PhpNamespace();
        $phpNamespase->setName($namespace);
        $this->namespace = $phpNamespase;

        return $this;
    }

    public function addUse($use)
    {
        $phpUse = new PhpUse();
        $phpUse->setName($use);
        $this->uses[] = $phpUse;

        return $this;
    }

    public function makePublicProperty($name, $description = null)
    {
        $property = $this->makeProperty($name, $description);

        $property->setVisiblityPublic();
    }

    public function makeProtectedProperty($name, $description = null)
    {
        $property = $this->makeProperty($name, $description);

        $property->setVisiblityProtected();

        return $this;
    }

    public function makePrivateProperty($name, $description = null)
    {
        $property = $this->makeProperty($name, $description);

        $property->setVisiblityPrivate();
        
        return $this;
    }

    public function addMethod(Method $method)
    {
        $this->methods[] = $method;

        return $this;
    }

    private function makeProperty($name, $description = null)
    {
        $property = new PhpClass\Property();

        $property
            ->setName($name)
            ->setDescription($description);

        $this->properties[] = $property;

        return $property;
    }

    public function render()
    {
        $uses       = join("\n", $this->uses);
        $properties = join("\n", $this->properties);
        $methods    = join("\n", $this->methods);

        return <<<PHP
{$this->namespace}
{$uses}

/**
 * {$this->description}
*/
class {$this->name}
{
{$properties}
    
{$methods}
}
PHP;
    }
}
