<?php

namespace PhpCodeMaker\PhpClass;

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

        return $this;
    }

    public function setVisiblityProtected()
    {
        $this->visiblity = 'protected';

        return $this;
    }

    public function setVisiblityPrivate()
    {
        $this->visiblity = 'private';

        return $this;
    }
}
