<?php

namespace PhpCodeMaker\PhpClass;

use PhpCodeMaker\Element;
use PhpCodeMaker\PhpDocs;

class Constant extends Element
{
    /**
     * @var PhpDocs
     */
    private $phpDocs;

    /**
     * @var string|int
     */
    private $value;

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
     * @param int|string $value
     *
     * @return $this
     */
    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    public function render(): string
    {
        $phpDocs = $this->phpDocs->render();
        $phpDocs = str_replace("\n", "\n    ", $phpDocs);
        $value   = is_string($this->value) ? "'{$this->value}'" : $this->value;

        return <<<PHP
    {$phpDocs}
    constant {$this->name} = {$value};\n
PHP;
    }
}
