<?php

declare(strict_types=1);
/**
 * This file is part of friendsofhyperf/components.
 *
 * @link     https://github.com/friendsofhyperf/components
 * @document https://github.com/friendsofhyperf/components/blob/3.x/README.md
 * @contact  huangdijia@gmail.com
 */
namespace FriendsOfHyperf\PrettyConsole\Aspect;

use FriendsOfHyperf\PrettyConsole\View\Components\Factory;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use ReflectionObject;

#[Aspect]
class CommandAspect extends AbstractAspect
{
    public array $classes = [
        'Hyperf\Command\Command::run',
    ];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $instance = $proceedingJoinPoint->getInstance();
        $reflection = new ReflectionObject($instance);
        $output = $proceedingJoinPoint->getArguments()[1];
        $factory = new Factory($output);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            if ($property->getType() && $property->getType()->getName() == Factory::class) {
                $property->setValue($instance, $factory);
            }
        }

        return $proceedingJoinPoint->process();
    }
}
