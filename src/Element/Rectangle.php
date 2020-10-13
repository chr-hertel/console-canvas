<?php

declare(strict_types=1);

namespace Stoffel\Console\Canvas\Element;

use Stoffel\Console\Canvas\Dimension;
use Stoffel\Console\Canvas\ElementInterface;
use Stoffel\Console\Canvas\Fill;

class Rectangle implements ElementInterface
{
    private Dimension $dimension;
    private Fill $fill;

    public function __construct(Dimension $dimension, Fill $fill)
    {
        $this->dimension = $dimension;
        $this->fill = $fill;
    }

    public function getDimension(): Dimension
    {
        return $this->dimension;
    }

    public function getContent(): string
    {
        $content = '';
        for ($y = 0; $y < $this->getDimension()->getHeight(); $y++) {
            $content .= str_repeat('█', $this->getDimension()->getWidth()).PHP_EOL;
        }

        return $this->fill->apply($content);
    }
}
