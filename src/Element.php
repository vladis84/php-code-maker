<?php

namespace ClassGen;

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

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public abstract function render();

    public function __toString()
    {
        return $this->render();
    }
}
