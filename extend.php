<?php

use Flarum\Extend;
use Flarum\User\Event\Saving;
use TacraftSociality\EmailLimits\Listener\EnforceEmailDomain;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Settings())
        ->default('tacraft-sociality-email-limits.suffixes', ''),

    (new Extend\Event())
        ->listen(Saving::class, EnforceEmailDomain::class),
];
