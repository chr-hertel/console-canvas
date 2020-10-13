<?php

declare(strict_types=1);

namespace Stoffel\Console\Canvas\Element;

use Laminas\Text\Figlet\Figlet;
use Stoffel\Console\Canvas\Dimension;
use Stoffel\Console\Canvas\ElementInterface;
use Stoffel\Console\Canvas\Fill;
use Stoffel\Console\Headline\HeadlineHelper;
use Symfony\Component\Console\Output\NullOutput;

class Headline implements ElementInterface
{
    private HeadlineHelper $headlineHelper;
    private Fill $fill;

    public function __construct(string $text, Fill $fill, array $options = [])
    {
        $defaults = ['justification' => Figlet::JUSTIFICATION_LEFT];

        $this->fill = $fill;
        $this->headlineHelper = HeadlineHelper::create(new NullOutput())
            ->setText($text)
            ->setFigletOptions(array_merge($defaults, $options));
    }

    public function getDimension(): Dimension
    {
        return new Dimension(
            $this->headlineHelper->getWidth(),
            $this->headlineHelper->getHeight(),
        );
    }

    public function getContent(): string
    {
        return $this->fill->apply($this->headlineHelper->render());
    }
}
