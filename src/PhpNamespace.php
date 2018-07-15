<?php

namespace PhpCodeMaker;

/**
 *
 */
class PhpNamespace extends Element
{
    public function render(): string
    {
        return "namespace {$this->name};";
    }
}
