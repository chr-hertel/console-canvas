<?php

declare(strict_types=1);

namespace Stoffel\Console\Canvas;

use Stoffel\Console\Canvas\Element\Rectangle;
use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Terminal;

class CanvasHelper
{
    private Cursor $cursor;
    private OutputInterface $output;
    private int $width;
    private int $height;
    private ?Fill $background;
    /** @var ElementInterface[] */
    private array $elements;

    private function __construct(OutputInterface $output, int $width, int $height)
    {
        $this->cursor = new Cursor($output);
        $this->cursor->hide();
        $this->output = $output;
        $this->width = $width;
        $this->height = $height;
    }

    public function __destruct()
    {
        $this->cursor->show();
    }

    public static function create(OutputInterface $output, int $width = null, int $height = null): self
    {
        $terminal = new Terminal();

        return new self(
            $output,
            $width ?? $terminal->getWidth(),
            $height ?? $terminal->getHeight(),
        );
    }

    public function setBackground(Fill $fill = null): self
    {
        $this->background = $fill;

        return $this;
    }

    public function addElement(Position $position, ElementInterface $element): self
    {
        $this->elements[] = [$position, $element];

        return $this;
    }

    public function draw(): void
    {
        $elements = $this->elements;

        if (null !== $this->background) {
            $background = [
                new Position(0, 0),
                new Rectangle(new Dimension($this->width, $this->height), $this->background)
            ];
            $elements = [$background, ...$elements];
        }

        foreach ($elements as [$position, $element]) {
            $content = $element->getContent();
            foreach (explode(PHP_EOL, $content) as $yFactor => $line) {
                $this->cursor->moveToPosition($position->getX(), $position->getY() + $yFactor);
                $this->output->write($line);
            }
        }

        $this->cursor->moveToPosition($this->width, $this->height);
    }
}
