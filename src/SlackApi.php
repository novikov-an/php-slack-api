<?php

namespace ANovikov;

use ANovikov\Error\SlackApiException;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

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
     * @var string
     */
    private $apiBase = 'https://slack.com/api/';

    /**
     * @return string
     */
    public function getAppToken(): string
    {
        return $this->appToken;
    }

    /**
     * @return string
     */
    public function getBotToken(): string
    {
        return $this->botToken;
    }

    /**
     * @return string
     */
    public function getApiBase(): string
    {
        return $this->apiBase;
    }

    /**
     * @param string $apiBase
     * @throws SlackApiException
     */
    public function setApiBase(string $apiBase): void
    {
        $isValid = filter_var($apiBase, FILTER_VALIDATE_URL);
        SlackApiException::throwIf(!$isValid, SlackApiException::INVALID_BASE_API);

        $this->apiBase = $apiBase;
    }

    /**
     * SlackApi constructor.
     *
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
     * @param array $data
     * @return Response
     * @throws SlackApiException
     */
    public function send(string $type, string $endpoint, array $data = []): Response
    {
        $this->validateType($type);
        $fullUrl = $this->getFullUrl($endpoint);

        $requestOptions = $type === self::REQUEST_POST
            ? RequestOptions::JSON
            : RequestOptions::QUERY;

//        if (!$this->isValid($endpoint, $args)) {
//            return $this->response->generate($this->getErrors());
//        }

        try {
            /** @var \GuzzleHttp\Psr7\Response $response */
            $response = $this->client->$type($fullUrl, [
                'headers' => $this->getHeaders(),
                $requestOptions => $data
            ]);
            $data = $response->getBody()->getContents();
            print_r($data);exit;
        } catch (\Exception $exception) {

        }

        return $this->response->generate([]);
        // validate
            // if invalid - send response object
        // send request
        // handle data
        // send response object
    }

    /**
     * @param string $endpoint
     * @return string
     */
    private function getFullUrl(string $endpoint): string
    {
        return sprintf('%s/%s', trim($this->getApiBase(), '/'), $endpoint);
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

    /**
     * Return default headers for slack
     * @return array
     */
    public function getHeaders(): array
    {
        return [
            'Authorization' => sprintf('Bearer %s', !$this->isBot
                ? $this->getAppToken()
                : $this->getBotToken()
            ),
            'Accept-Encoding' => 'gzip, deflate',
            'Content-Type' => 'application/json; charset=utf-8'
        ];
    }
}
