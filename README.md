# Console Canvas
Helper to draw graphics and compose elements on top of Symfony Console Component.

## Example

```bash
$ git clone git@github.com:chr-hertel/console-canvas.git
$ cd console-canvas
$ composer install
$ example/rectangles
```

## Installation

```bash
$ composer require stoffel/console-canvas
```

Usage in PHP

```php
use Stoffel\Console\Canvas\CanvasHelper;
use Stoffel\Console\Canvas\Element\Headline;
use Stoffel\Console\Canvas\Element\Image;
use Stoffel\Console\Canvas\Element\Rectangle;
use Stoffel\Console\Canvas\Fill;
use Stoffel\Console\Canvas\Dimension;
use Stoffel\Console\Canvas\Position;

$canvas = CanvasHelper::create($output);
$canvas
    ->setBackground(Fill::withGradient(['#000000', '#999999']))
    ->addElement(new Position(10, 10), new Rectangle(new Dimension(10, 5), Fill::withColor('#FF0000')))
    ->addElement(new Position(50, 5), new Rectangle(new Dimension(20, 5), Fill::withGradient('summer')))
    ->addElement(new Position(100, 5), new Image('/path/to/image.jpg', new Dimension(30, 25)))
    ->addElement(new Position(10, 40), new Headline('Hello World', Fill::withColor('yellow')))
    ->draw();
```
