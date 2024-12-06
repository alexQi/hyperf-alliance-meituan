<?php

namespace HyperfAlliance\Meituan\Providers;

use AlexQiu\Sdkit\ServiceContainer;
use HyperfAlliance\Meituan\Caller;

/**
 * Client
 *
 * @author  alex
 * @package HyperfAlliance\Meituan\Client
 */
class CallerProvider
{
    /**
     * @param ServiceContainer $service
     *
     * @return void
     */
    public function register(ServiceContainer $service): void
    {
        $service->getContainer()->set("caller", function () use ($service) {
            return new Caller($service);
        });
    }
}