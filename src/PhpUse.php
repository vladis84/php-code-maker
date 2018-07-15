<?php

namespace PhpCodeMaker;

class PhpUse extends Element
{
    public function render(): string
    {
        return "use {$this->name};";
    }
}

