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
    // 要切入的类或 Trait，可以多个，亦可通过 :: 标识到具体的某个方法，通过 * 可以模糊匹配
    public array $classes = [
        'Hyperf\Command\Command::run',
    ];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $instance = $proceedingJoinPoint->getInstance();
        $reflection = new ReflectionObject($instance);

        if ($reflection->hasProperty('components')) {
            $output = $proceedingJoinPoint->getArguments()[1];
            $reflection->getProperty('components')->setValue($instance, new Factory($output));
        }

        return $proceedingJoinPoint->process();
    }
}
