<?php

namespace ANovikov;

use ANovikov\Error\SlackApiException;
use ANovikov\Helpers\Hydration;
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
     * @var Hydration
     */
    private $hydration;

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
        $this->hydration = new Hydration();

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
            $body = $response->getBody() ?? '';
            $data = json_decode($body, true);
        } catch (\Exception $exception) {

        }

        /** @var Response $response */
        $response = $this->hydration->toObject($data, $this->response);
        $response->setBody($data);

        return $response;
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

    /**
     * @param string $groupId
     * @return Response
     * @throws SlackApiException
     */
    public function conversationInfo(string $groupId): Response
    {
        $args = [
            'channel' => $groupId
        ];

        return $this->get('conversations.info', $args);
    }

    /**
     * @param string $string
     * @param array $options
     * @return Response
     * @throws SlackApiException
     * @link https://api.slack.com/methods/conversations.history
     */
    public function conversationHistory(string $string, array $options = []): Response
    {
        $args = [
            'channel' => $string,
        ];

        if ($args) {
            $args = array_merge($args, $options);
        }

        return $this->get('conversations.history', $args);
    }

    /**
     * @param string $channelId
     * @param string $messageTs
     * @return Response
     * @throws SlackApiException
     */
    public function deleteMessage(string $channelId, string $messageTs): Response
    {
        $args = [
            'channel' => $channelId,
            'ts' => $messageTs
        ];

        return $this->post('chat.delete', $args);
    }
}
