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

use InvalidArgumentException;
use Symfony\Component\Console\Style\SymfonyStyle;

class Factory
{
    /**
     * The output interface implementation.
     *
     * @var SymfonyStyle
     */
    protected $output;

    /**
     * Creates a new factory instance.
     *
     * @param SymfonyStyle $output
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
