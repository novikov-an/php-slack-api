<?php
namespace ANovikov;

use ANovikov\Helpers\Hydration;
use ANovikov\Response\Type\Channel;

/**
 * Class Response
 * @package ANovikov
 */
class Response
{
    /**
     * @var bool
     */
    private $ok = false;

    /**
     * @var array
     */
    private $body = [];

    /**
     * @var Channel
     */
    private $channel;

    /**
     * @var Hydration
     */
    private $hydration;

    /**
     * @var array
     */
    private $messages = [];

    /**
     * Response constructor.
     */
    public function __construct()
    {
        $this->hydration = new Hydration();
        $this->channel = new Channel();
    }

    /**
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->ok;
    }

    /**
     * @param bool $ok
     * @return Response
     */
    public function setOk(bool $ok): Response
    {
        $this->ok = $ok;
        return $this;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @param array $body
     */
    public function setBody(array $body): void
    {
        $this->body = $body;
    }


    /**
     * @return Channel
     */
    public function getChannel(): Channel
    {
        return $this->channel;
    }

    /**
     * @param array|string $channel
     * @return Response
     */
    public function setChannel($channel): self
    {
        $args = is_string($channel) ? ['name' => $channel] : $channel;
        $this->channel = $this->hydration->toObject($args, $this->channel);

        return $this;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param array $messages
     * @return Response
     */
    public function setMessages(array $messages): Response
    {
        $this->messages = $messages;
        return $this;
    }
}
