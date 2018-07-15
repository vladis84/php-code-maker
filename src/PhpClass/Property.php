<?php

namespace PhpCodeMaker\PhpClass;

use PhpCodeMaker\Element;
use PhpCodeMaker\PhpDocs;

class Property extends Element
{
    use VisiblityTrait;

    /**
     * @var PhpDocs
     */
    private $phpDocs;

    public function __construct()
    {
        $this->setVisiblityPublic();
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

    public function addPhpDoc(string $name, string $description = null)
    {
        $this->phpDocs->makePhpDoc($name, $description);

        return $this;
    }

    public function render(): string
    {
        $phpDocs = $this->phpDocs->render();

        return <<<PHP
    {$phpDocs}
    {$this->visiblity} \${$this->name};\n
PHP;
    }
}
