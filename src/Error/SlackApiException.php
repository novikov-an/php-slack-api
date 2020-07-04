<?php

namespace ANovikov\Error;

use Exception;

/**
 * Class SlackApiException
 * @package ANovikov\Error
 */
class SlackApiException extends Exception
{
    public const SOMETHING_WENT_WRONG = 1;
    public const SPECIFY_ONE_TOKEN = 2;
    public const NOT_AVAILABLE_REQUEST = 3;
    public const INVALID_BASE_API = 4;

    public const MESSAGES = [
        self::SPECIFY_ONE_TOKEN => 'Please specify at least one token: APP or Bot',
        self::SOMETHING_WENT_WRONG => 'Something went wrong',
        self::NOT_AVAILABLE_REQUEST => 'This request is not supported, please provide POST or GET',
        self::INVALID_BASE_API => 'Please provide a valid base API',
    ];

    /**
     * @param int $code
     * @return string
     */
    public static function getMessages(int $code): string
    {
        return self::MESSAGES[$code] ?? self::MESSAGES[self::SOMETHING_WENT_WRONG];
    }

    /**
     * @param $condition
     * @param int $errorCode
     * @throws SlackApiException
     */
    public static function throwIf($condition, int $errorCode): void
    {
        if (!$condition) {
            return;
        }

        throw new self(self::getMessages($errorCode));
    }
}
