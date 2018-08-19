<?php

namespace PhpCodeMaker;

class PhpDocs implements ElementInterface
{
    /**
     * @var PhpDoc[]
     */
    private $phpDocs = [];

    /**
     * @var string
     */
    private $description;

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param string $name
     * @param string $description
     *
     * @return $this
     */
    public function makePhpDoc(string $name, string $description = null): self
    {
        $phpDoc = new PhpDoc();
        $phpDoc
            ->setName($name)
            ->setDescription($description)
        ;

        $this->phpDocs[] = $phpDoc;

        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $phpDocs = '';
        foreach ($this->phpDocs as $phpDoc) {
            $phpDocs .= $phpDoc->render();
        }

        $description = '';
        if ($this->description) {
            $description =  "\n * {$this->description}";
        }

        if (empty($description) && empty($phpDocs)) {
            return '';
        }

        return <<<PHP
/**{$description}
{$phpDocs}*/
PHP;
    }
}
