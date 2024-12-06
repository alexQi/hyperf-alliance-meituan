<?php

declare(strict_types=1);
/**
 * This file is part of msmm.
 */

namespace HyperfAlliance\Meituan;

use AlexQiu\Sdkit\ServiceContainer;
use Hyperf\Contract\ConfigInterface;
use HyperfAlliance\Meituan\Providers\CallerProvider;
use HyperfAlliance\Meituan\Providers\HttpServiceClientProvider;

/**
 * 美团客户端类，用于发送请求到美团接口。
 */

/**
 * 美团客户端类，用于发送请求到美团接口。
 * Service
 *
 * @property Caller $caller
 * @author  alex
 * @package HyperfAlliance\Meituan\Service
 */
class Service extends ServiceContainer
{

    /**
     * @var ConfigInterface
     */
    protected $config;

    protected $providers = [
        HttpServiceClientProvider::class,
        CallerProvider::class
    ];

    /**
     * Constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct($config);
    }
}
