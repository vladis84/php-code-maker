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
     * @var PhpDoc
     */
    private $phpDocs;

    public function __construct()
    {
        $this->phpDocs = new PhpDocs();
    }

    /**
     * Создает параметр функции
     *
     * @param $name
     * @param $type
     * @param null $description
     *
     * @return $this
     */
    public function makeParam($name, $type, $description = null): self
    {
        $param = new Param;

        $param
            ->setName($name)
            ->setType($type)
            ->setDescription($description);

        $this->params[] = $param;

        $phpDocDescription = sprintf('%s $%s %s', $param->type, $param->name, $param->description);
        $this->phpDocs->makePhpDoc('@param', $phpDocDescription);

        return $this;
    }

    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    public function render(): string
    {
        $params = join(', ', $this->params);
        $this->phpDocs->setDescription($this->description);
        $phpDocs = $this->phpDocs->render();


        return <<<PHP
{$phpDocs}
function {$this->name} ({$params})
{
    {$this->code}
}
PHP;
    }
}
