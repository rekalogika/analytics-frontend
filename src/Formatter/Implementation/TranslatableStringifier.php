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

namespace Rekalogika\Analytics\Frontend\Formatter\Implementation;

use Rekalogika\Analytics\Common\Model\TranslatableMessage;
use Rekalogika\Analytics\Frontend\Formatter\Stringifier;
use Rekalogika\Analytics\Frontend\Formatter\Unsupported;
use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class TranslatableStringifier implements Stringifier
{
    public function __construct(
        private TranslatorInterface $translator,
    ) {}

    #[\Override]
    public function toString(mixed $input): string
    {
        if ($input instanceof TranslatableInterface) {
            return $input->trans($this->translator);
        }

        if ($input === null) {
            return (new TranslatableMessage('(None)'))->trans($this->translator);
        }

        if (\is_bool($input)) {
            return $input
                ? (new TranslatableMessage('True'))->trans($this->translator)
                : (new TranslatableMessage('False'))->trans($this->translator);
        }

        throw new Unsupported();
    }
}
