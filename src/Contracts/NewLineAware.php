<?php

declare(strict_types=1);
/**
 * This file is part of friendsofhyperf/components.
 *
 * @link     https://github.com/friendsofhyperf/components
 * @document https://github.com/friendsofhyperf/components/blob/3.x/README.md
 * @contact  huangdijia@gmail.com
 */
namespace FriendsOfHyperf\PrettyConsole\Contracts;

interface NewLineAware
{
    /**
     * Whether a newline has already been written.
     *
     * @return bool
     */
    public function newLineWritten();
}
