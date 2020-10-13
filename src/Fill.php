<?php

declare(strict_types=1);

namespace Stoffel\Console\Canvas;

use Stoffel\Console\Gradient\GradientHelper;
use Symfony\Component\Console\Color;

class Fill
{
    private object $filling;

    private function __construct()
    {
    }

    public static function withColor(string $foreground, string $background = '', array $options = []): self
    {
        $fill = new self();
        $fill->filling = new Color($foreground, $background, $options);

        return $fill;
    }

    /**
     * @var string|array $gradient
     */
    public static function withGradient($gradient): self
    {
        $fill = new self();

        if (is_array($gradient)) {
            $fill->filling = GradientHelper::create()->setColors($gradient);

            return $fill;
        }

        $fill->filling = GradientHelper::create()->setStyle($gradient);

        return $fill;
    }

    public function apply(string $text): string
    {
        if ($this->filling instanceof Color) {
            return $this->filling->apply($text);
        }

        if ($this->filling instanceof GradientHelper) {
            return $this->filling->setText($text)->colorize();
        }
    }
}
