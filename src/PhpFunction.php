<?php

namespace ClassGen;

/**
 *
 */
class PhpFunction extends Element
{
    /**
     * Входной параметр функции
     * @var PhpFunction\Param[]
     */
    protected $params = [];

    /**
     * Код функции
     * @var string
     */
    protected $code;

    public function render()
    {
        $params = join(', ', $this->params);

        return <<<PHP
/**
 * {$this->description}
*/
function {$this->name} ({$params})
{
    {$this->code}
}
PHP;
    }
}
