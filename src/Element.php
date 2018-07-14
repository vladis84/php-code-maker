<?php

namespace PhpCodeMaker;

abstract class Element
{
    /**
     * Название класса
     * @var string
     */
    protected $name;

    /**
     * Описание класса
     * @var string
     */
    protected $description;

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function __toString()
    {
        return $this->render();
    }

    public abstract function render();

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
