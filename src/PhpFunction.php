<?php

namespace PhpCodeMaker;

use PhpCodeMaker\PhpFunction\Param;

/**
 * Функция
 */
class PhpFunction extends Element
{
    /**
     * Входной параметр функции
     * @var PhpFunction\Param[]
     */
    private $params = [];

    /**
     * Код функции
     * @var string
     */
    private $code;

    /**
     * Создает параметр функции
     * @param string $name
     * @param string $type
     * @param string $description
     */
    public function makeParam($name, $type, $description = null)
    {
        $param = new Param;

        $param
            ->setName($name)
            ->setType($type)
            ->setDescription($description);

        $this->params[] = $param;

        return $this;
    }

    public function setCode($code)
    {
        $this->code = $code;
        
        return $this;
    }

    public function render()
    {
        $params = join(', ', $this->params);

        return <<<PHP
/**
 * {$this->description}
{$this->renderPhpDocForParams()}
*/
function {$this->name} ({$params})
{
    {$this->code}
}
PHP;
    }

    private function renderPhpDocForParams()
    {
        $paramDocs = [];

        foreach ($this->params as $param) {
            $paramDocs[] = " * @param {$param->type} \${$param->name} {$param->description}";
        }

        return join("\n", $paramDocs);
    }
}
