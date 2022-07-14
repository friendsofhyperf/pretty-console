# Pretty Console

## Installation

```shell
composer require friendsofhyperf/pretty-console
```

## Usage

```php
<?php
use FriendsOfHyperf\PrettyConsole\View\Components\Factory;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;

#[Command]
class FooCommand extends HyperfCommand
{
    protected Factory $components;

    public function function handle()
    {
        $this->components->info('Your message here.');
    }
}
```

## Thanks

- [nunomaduro/termwind](https://github.com/nunomaduro/termwind)
- [The idea from pr of laravel](https://github.com/laravel/framework/pull/43065)