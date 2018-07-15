<?php

namespace PhpCodeMaker;

use PhpCodeMaker\PhpClass\Method;
use PhpCodeMaker\PhpClass\Property;

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

    /**
     * @var PhpDocs
     */
    private $phpDocs;

    public function __construct()
    {
        $this->phpDocs = new PhpDocs();
    }

    public function addPhpDoc(string $name, string $description = null)
    {
        $this->phpDocs->makePhpDoc($name, $description);

        return $this;
    }

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

    /**
     * @param Property $property
     *
     * @return $this
     */
    public function addProperty(Property $property): self
    {
        $this->properties[] = $property;

        return $this;
    }

    public function makePublicProperty($name, $description = null): self
    {
        $property = $this->makeProperty($name, $description);

        $property->setVisiblityPublic();

        return $this;
    }

    public function makeProperty($name, $description = null)
    {
        $property = new PhpClass\Property();

        $property
            ->setName($name)
            ->setDescription($description);

        $this->properties[] = $property;

        return $property;
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

    /**
     * @param Method $method
     *
     * @return $this
     */
    public function addMethod(Method $method): self
    {
        $this->methods[] = $method;

        return $this;
    }

    public function render(): string
    {
        $uses       = join("\n", $this->uses);
        $properties = join("\n", $this->properties);
        $methods    = join("\n", $this->methods);
        $extends    = $this->inherits ? " extends $this->inherits" : '';
        $implements = '';

        if ($this->implements) {
            $implements = " implements " . join(', ', $this->implements);
        }

        $this->phpDocs->setDescription($this->description);
        $phpDocs = $this->phpDocs->render();

        return <<<PHP
<?php
{$this->namespace}
{$uses}

{$phpDocs}
class {$this->name}{$extends}{$implements}
{
{$properties}
    
{$methods}
}
PHP;
    }

    /**
     * Установить наследуемый класс
     *
     * @param $inherits
     *
     * @return $this
     */
    public function setInherits($inherits): self
    {
        $this->inherits = $inherits;

        return $this;
    }

    /**
     * Установить реализуемые интерфейсы
     *
     * @param $this
     */
    public function setImplements($implementsInterfaces): self
    {
        $this->implements = $implementsInterfaces;

        return $this;
    }
}
