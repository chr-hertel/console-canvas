<?php

declare(strict_types=1);

namespace Stoffel\Console\Canvas\Element;

use Stoffel\Console\Canvas\Dimension;
use Stoffel\Console\Canvas\ElementInterface;
use Stoffel\Console\Image\ImageHelper;

class Image implements ElementInterface
{
    private string $imagePath;
    private Dimension $dimension;

    public function __construct(string $imagePath, Dimension $dimension)
    {
        $this->imagePath = $imagePath;
        $this->dimension = $dimension;
    }

    public function getDimension(): Dimension
    {
        return $this->dimension;
    }

    public function getContent(): string
    {
        return ImageHelper::create()
            ->render($this->imagePath, $this->dimension->getWidth(), $this->dimension->getHeight());
    }
}
