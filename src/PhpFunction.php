<?php

namespace ClassGen;

use ClassGen\PhpFunction\Param;

/**
 *
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

    public function addParam(Param $param)
    {
        $this->params[] = $param;

        return $this;
    }

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

        $this->addParam($param);

        return $param;
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
