<?php

namespace PhpCodeMaker;

class PhpDoc extends Element
{
    private $description;

    /**
     * @param mixed $description
     *
     * @return $this
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        if (!$this->name) {
            return '';
        }

        return " * {$this->name} {$this->description}\n";
    }
}
