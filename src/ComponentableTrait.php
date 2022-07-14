<?php

declare(strict_types=1);
/**
 * This file is part of friendsofhyperf/components.
 *
 * @link     https://github.com/friendsofhyperf/components
 * @document https://github.com/friendsofhyperf/components/blob/3.x/README.md
 * @contact  huangdijia@gmail.com
 */
namespace FriendsOfHyperf\PrettyConsole;

use FriendsOfHyperf\PrettyConsole\View\Components\Factory;

trait ComponentableTrait
{
    protected ?Factory $components = null;

    public function initComponents(): void
    {
        $this->components = new Factory($this->output);
    }
}
