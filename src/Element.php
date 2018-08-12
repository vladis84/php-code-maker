<?php

namespace PhpCodeMaker;

abstract class Element implements ElementInterface
{
    /**
     * @var string
     */
    protected $name;

    public function __toString()
    {
        return $this->render();
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }
}
