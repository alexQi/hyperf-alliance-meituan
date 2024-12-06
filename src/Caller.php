<?php

namespace HyperfAlliance\Meituan;

use AlexQiu\Sdkit\BaseClient as KitBaseClient;
use GuzzleHttp\Exception\GuzzleException;
use HyperfAlliance\Meituan\Contract\RequestInterface;
use HyperfAlliance\Meituan\Exception\ResultErrorException;
use HyperfAlliance\Meituan\Utils\SignUtil;
use Psr\Http\Message\ResponseInterface;

/**
 * Client
 *
 * @author  alex
 * @package HyperfAlliance\Meituan\Client
 */
class Caller extends KitBaseClient
{
    /**
     * @param RequestInterface $request
     *
     * @return \AlexQiu\Sdkit\Support\Collection|array|object|ResponseInterface|string
     * @throws GuzzleException
     * @throws \AlexQiu\Sdkit\Exceptions\InvalidConfigException
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function send(RequestInterface $request)
    {
        $url        = $request->getApiMethodName();
        $dataString = $request->getApiParams();
        $apiConfig  = $this->app->getContainer()->get("config");

        $config = [
            'app_key' => $apiConfig->get('app_key', ""),
            'secret'  => $apiConfig->get('app_secret', ""),
            'method'  => 'POST',
            'url'     => $url,
            'data'    => $dataString,
        ];
        return $this->fetch(
            $url,
            "POST",
            [
                "json"    => $request->getApiParams(),
                "headers" => SignUtil::getSignHeaders($config),
            ]
        );
    }

    /**
     * @param ResponseInterface $response
     *
     * @return \AlexQiu\Sdkit\Support\Collection|array|false|mixed|object|ResponseInterface|string|null
     * @throws \AlexQiu\Sdkit\Exceptions\InvalidConfigException
     */
    protected function unwrapResponse(ResponseInterface $response)
    {
        $res = parent::unwrapResponse($response);
        if ($res['code']) {
            throw new ResultErrorException($res['message'], $res['code']);
        }
        return $res["data"];
    }
}