<?php

declare(strict_types=1);

/*
 * This file is part of rekalogika/analytics package.
 *
 * (c) Priyadi Iman Nurcahyo <https://rekalogika.dev>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Rekalogika\Analytics\Frontend\Chart\Configuration;

use OzdemirBurak\Iris\Color\Hsl;

final readonly class ColorDispenser
{
    private Hsl $hsl;

    public function __construct()
    {
        $this->hsl = new Hsl('hsl(240,40%,50%)');
    }

    /**
     * @see https://softwareengineering.stackexchange.com/a/303974
     */
    public function dispenseColor(): string
    {
        $this->hsl->spin(137.5);

        return (string) $this->hsl->toHex();
    }
}
