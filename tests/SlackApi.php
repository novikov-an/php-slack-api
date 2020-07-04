<?php

trait SlackApi
{
    private $appToken = '';
    private $botToken = '';

    /**
     * SlackApi constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getAppToken(): string
    {
        return $this->appToken;
    }

    /**
     * @param string $appToken
     */
    public function setAppToken(string $appToken): void
    {
        $this->appToken = $appToken;
    }

    /**
     * @return string
     */
    public function getBotToken(): string
    {
        return $this->botToken;
    }

    /**
     * @param string $botToken
     */
    public function setBotToken(string $botToken): void
    {
        $this->botToken = $botToken;
    }
}
