<?php

namespace ANovikov;

use ANovikov\Error\SlackApiException;
use GuzzleHttp\Client;

class SlackApi
{
    public const REQUEST_GET = 'get';
    public const REQUEST_POST = 'post';

    /**
     * @var string
     */
    private $appToken;

    /**
     * @var string
     */
    private $botToken;

    /**
     * @var bool
     */
    private $isBot = false;

    /**
     * @var Response
     */
    private $response;

    /**
     * @var Client
     */
    private $client;

    /**
     * SlackApi constructor.
     * @param string $appToken
     * @param string $botToken
     * @throws SlackApiException
     */
    public function __construct(string $appToken = '', string $botToken = '')
    {
        SlackApiException::throwIf(!$appToken && !$botToken, SlackApiException::SPECIFY_ONE_TOKEN);

        $this->appToken = $appToken;
        $this->botToken = $botToken;

        $this->response = new Response();

        $this->client = new Client();
    }

    /**
     * @return $this
     */
    public function asBot(): self
    {
        $this->isBot = true;
        return $this;
    }

    /*
     * @return $this
     */
    public function asApp(): SlackApi
    {
        $this->isBot = false;
        return $this;
    }

    /**
     * @param string $type
     * @param string $endpoint
     * @param array $args
     * @return Response
     * @throws SlackApiException
     */
    public function send(string $type, string $endpoint, array $args = []): Response
    {
        $this->validateType($type);

//        if (!$this->isValid($endpoint, $args)) {
//            return $this->response->generate($this->getErrors());
//        }

        return $this->response->generate([]);
        // validate
            // if invalid - send response object
        // send request
        // handle data
        // send response object
    }

    /**
     * @param string $endpoint
     * @param array $args
     * @return Response
     * @throws SlackApiException
     */
    public function get(string $endpoint, array $args = []): Response
    {
        return $this->send(self::REQUEST_GET, $endpoint, $args);
    }

    /**
     * @param string $endpoint
     * @param array $args
     * @return Response
     * @throws SlackApiException
     */
    public function post(string $endpoint, array $args = []): Response
    {
        return $this->send(self::REQUEST_POST, $endpoint, $args);
    }

    /**
     * @param string $endpoint
     * @param string $type
     * @return bool
     */
    public function isValid(string $endpoint, string $type): bool
    {
        return true;
    }
        /**
     * @return bool
     */
    public function isBot(): bool
    {
        return $this->isBot;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param string $type
     * @throws SlackApiException
     */
    public function validateType(string $type): void
    {
        $notAllowed = ($type !== self::REQUEST_GET && $type !== self::REQUEST_POST);
        SlackApiException::throwIf($notAllowed, SlackApiException::NOT_AVAILABLE_REQUEST);
    }
}
