<?php

declare(strict_types=1);
/**
 * This file is part of msmm.
 */

namespace HyperfAlliance\Meituan\Contract;

interface RequestInterface
{
    public function getResult(array $response);

    public function getApiMethodName();

    public function getApiParams();
}
