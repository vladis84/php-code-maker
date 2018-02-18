<?php

namespace PhpCodeMaker;

/**
 *
 */
class PhpNamespace extends Element
{
    public function render()
    {
        return "namespace {$this->name};";
    }
}
