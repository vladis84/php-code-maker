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
     * @param null|string $description
     *
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->phpDocs->setDescription($description);

        return $this;
    }

    /**
     * @param string $name
     * @param string $type
     * @param string|null $description
     *
     * @return $this
     */
    public function makeParam(string $name, string $type, string $description = null): self
    {
        $param = new Param;

        $param
            ->setName($name)
            ->setType($type)
        ;

        $this->params[] = $param;

        $phpDocDescription = sprintf('%s $%s %s', $param->type, $param->name, $description);
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
        $params  = join(', ', $this->params);
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
