<?php

declare(strict_types=1);
/**
 * This file is part of friendsofhyperf/components.
 *
 * @link     https://github.com/friendsofhyperf/components
 * @document https://github.com/friendsofhyperf/components/blob/3.x/README.md
 * @contact  huangdijia@gmail.com
 */
namespace FriendsOfHyperf\PrettyConsole\View\Components;

use FriendsOfHyperf\PrettyConsole\OutputStyle;
use InvalidArgumentException;

class Factory
{
    /**
     * The output interface implementation.
     *
     * @var OutputStyle
     */
    protected $output;

    /**
     * Creates a new factory instance.
     *
     * @param OutputStyle $output
     */
    public function __construct($output)
    {
        $this->output = $output;
    }

    /**
     * Dynamically handle calls into the component instance.
     *
     * @param string $method
     * @param array $parameters
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $component = '\FriendsOfHyperf\PrettyConsole\View\Components\\' . ucfirst($method);

        throw_unless(class_exists($component), new InvalidArgumentException(sprintf(
            'Console component [%s] not found.',
            $method
        )));

        return with(new $component($this->output))->render(...$parameters);
    }
}
