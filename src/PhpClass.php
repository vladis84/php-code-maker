<?php

namespace PhpCodeMaker;

use PhpCodeMaker\PhpClass\Constant;
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
     * Список констант
     * @var Constant[]
     */
    private $constants = [];

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

    /**
     * @param null|string $description
     *
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->phpDocs->setDescription($description);

        return $this;
    }

    /**
     * @param string $name
     * @param string|null $description
     *
     * @return $this
     */
    public function addPhpDoc(string $name, string $description = null): self
    {
        $this->phpDocs->makePhpDoc($name, $description);

        return $this;
    }

    public function setNamespace($namespace)
    {
        $phpNamespace = new PhpNamespace();
        $phpNamespace->setName($namespace);
        $this->namespace = $phpNamespace;

        return $this;
    }

    public function getNameSpace()
    {
        return $this->namespace;
    }

    public function addUse($use)
    {
        $phpUse = new PhpUse();
        $phpUse->setName($use);
        $this->uses[] = $phpUse;

        return $this;
    }

    public function addConstant(Constant $constant)
    {
        $this->constants[] = $constant;

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

    /**
     * @param $name
     * @param null $description
     *
     * @return Property
     */
    public function makeProperty(string $name, string $description = null): Property
    {
        $property = new PhpClass\Property();

        $property
            ->setName($name)
            ->setDescription($description)
        ;

        $this->properties[] = $property;

        return $property;
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
        $uses = join("\n", $this->uses);
        if ($uses) {
            $uses = "\n" . $uses . "\n";
        }

        $constants = join("\n", $this->constants);
        if ($constants) {
            $constants = "\n" . $constants;
        }

        $properties = join("\n", $this->properties);
        if ($properties) {
            $properties = "\n" . $properties;
        }

        $methods = join("\n", $this->methods);
        if ($methods) {
            $methods = "\n" . $methods;
        }

        $extends = $this->inherits ? " extends $this->inherits" : '';

        $implements = '';
        if ($this->implements) {
            $implements = " implements " . join(', ', $this->implements);
        }

        $phpDocs = $this->phpDocs->render();
        if ($phpDocs) {
            $phpDocs = "\n" . $phpDocs;
        }

        $phpCode = <<<PHP
<?php

{$this->namespace}
{$uses}{$phpDocs}
class {$this->name}{$extends}{$implements}
{{$constants}{$properties}{$methods}}

PHP;

        return $phpCode;
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
