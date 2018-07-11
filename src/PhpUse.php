<?php

namespace PhpCodeMaker;

class PhpUse extends Element
{
    public function render()
    {
        return "use {$this->name};";
    }
}

