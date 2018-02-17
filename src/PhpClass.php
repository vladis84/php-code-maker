<?php

namespace PhpCodeMaker;

use PhpCodeMaker\PhpClass\Property;

/**
 *
 */
class PhpClass extends Element
{
    /**
     * Список свойств
     * @var Property[]
     */
    private $properties = [];

    public function addProperty(Property $property)
    {
        $this->properties[] = $property;

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
    }

    public function makePrivateProperty($name, $description = null)
    {
        $property = $this->makeProperty($name, $description);

        $property->setVisiblityPrivate();

    }

    private function makeProperty($name, $description = null)
    {
        $property = new PhpClass\Property();

        $property
            ->setName($name)
            ->setDescription($description);

        $this->addProperty($property);

        return $property;
    }

    public function render()
    {
        $properties = join("\n", $this->properties);

        return <<<PHP
/**
 * {$this->description}
*/
class {$this->name}
{
    {$properties}
}
PHP;
    }
}
