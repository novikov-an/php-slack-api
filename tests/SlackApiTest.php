<?php

use ANovikov\Error\SlackApiException;
use ANovikov\Response;
use ANovikov\SlackApi;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

/**
 * Class SlackApiTest
 */
class SlackApiTest extends TestCase
{
    public const APP_TOKEN = '';
    public const BOT_TOKEN = '';

    /**
     * @var SlackApi
     */
    private $slackApi;

    /**
     * SlackApiTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->slackApi = new SlackApi(self::APP_TOKEN, self::BOT_TOKEN);
    }

    /**
     * @test
     */
    public function cant_create_without_bot_tokens(): void
    {
        $this->expectException(SlackApiException::class);
        new SlackApi('', '');
    }


    /**
     * @test
     */
    public function can_use_as_bot(): void
    {
        $this->slackApi->asBot();
        $this->assertTrue($this->slackApi->isBot());
    }

    /**
     * @test
     */
    public function can_use_as_app(): void
    {
        $this->slackApi->asApp();
        $this->assertNotTrue($this->slackApi->isBot());
    }

    /**
     * @test
     */
    public function has_guzzle_client_property(): void
    {
        $client = $this->slackApi->getClient();
        $this->assertSame(get_class($client), Client::class);
    }

    /**
     * @test
     */
    public function has_sending_request_methods(): void
    {
        $checkingMethods = [
            'send',
            'post',
            'get'
        ];

        foreach ($checkingMethods as $method) {
            $this->assertTrue(method_exists($this->slackApi, $method));
        }
    }

    /**
     * @test
     */
    public function cant_send_different_types(): void
    {
        $this->expectException(SlackApiException::class);
        $this->slackApi->send('put', 'endpoint');
    }

    /**
     * @test
     * @throws SlackApiException
     */
    public function send_method_return_response_class(): void
    {
        $getResponse = $this->slackApi->get('slack.api');
        $postResponse = $this->slackApi->post('slack.api');

        $this->assertEquals(Response::class, get_class($getResponse));
        $this->assertEquals(Response::class, get_class($postResponse));
    }

    /**
     * @test
     */
    public function cant_set_non_valid_api_base()
    {
        $cases = [
            '',
            'not-url',
        ];

        $this->expectException(SlackApiException::class);
        foreach ($cases as $url) {
            $this->slackApi->setApiBase($url);
        }
    }
}
