<?php

declare(strict_types=1);
/**
 * This file is part of msmm.
 */

namespace HyperfAlliance\Meituan\Requests;

use HyperfAlliance\Meituan\Contract\RequestInterface;
use HyperfAlliance\Meituan\Exception\ResultErrorException;

abstract class AbstractRequest implements RequestInterface
{
    /**
     * 解析结果.
     *
     * @param mixed $response
     *
     * @return mixed
     * @throws \Exception
     */
    public function getResult(array $response)
    {
        $code = $response['code'] ?? 301;
        $code = $code == 200 ? 301 : $code;
        if ($code !== 0) {
            throw new ResultErrorException($response['message'] ?? '', $code);
        }
        return $response;
    }
}
