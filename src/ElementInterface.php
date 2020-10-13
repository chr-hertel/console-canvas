<?php

declare(strict_types=1);

namespace Stoffel\Console\Canvas;

interface ElementInterface
{
    public function getDimension(): Dimension;

    public function getContent(): string;
}
