<?php

namespace ClassGen\PhpClass;

/**
 *
 */
trait VisiblityTrait
{
    /**
     * Область видимости
     * @var string
     */
    private $visiblity = 'public';

    public function setVisiblityPublic()
    {
        $this->visiblity = 'public';
    }

    public function setVisiblityProtected()
    {
        $this->visiblity = 'protected';
    }

    public function setVisiblityPrivate()
    {
        $this->visiblity = 'private';
    }
}
