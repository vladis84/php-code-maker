<?php

namespace PhpCodeMaker;

use PhpCodeMaker\PhpClass\Method;

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

    /**
     * Наследуемый класс
     * @var string
     */
    private $inherits;

    /**
     * Реализуемые интерфейсы
     * @var string[]
     */
    private $implements;

    public function setNamespace($namespace)
    {
        $papNamespace = new PhpNamespace();
        $papNamespace->setName($namespace);
        $this->namespace = $papNamespace;

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
        $extends    = $this->inherits ? " extends $this->inherits" : "";
        $implements = "";

        if ($this->implements){
            $implements = " implements ".join(", ", $this->implements);
        }


        return <<<PHP
<?php
{$this->namespace}
{$uses}

/**
 * {$this->description}
*/
class {$this->name}{$extends}{$implements}
{
{$properties}
    
{$methods}
}
PHP;
    }

    /**
     * Установить наследуемый класс
     * @param $inherits
     */
    public function setInherits($inherits)
    {
        $this->inherits = $inherits;
    }

    /**
     * Установить реализуемые интерфейсы
     * @param $implementsInterfaces
     */
    public function setImplements($implementsInterfaces)
    {
        $this->implements = $implementsInterfaces;
    }
}
