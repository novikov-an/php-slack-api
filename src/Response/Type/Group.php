<?php

namespace ANovikov\Response\Type;

/**
 * Class Group
 * @package ANovikov\Response\Type
 */
class Group
{
    /**
     * @var string
     */
    private $id = '';

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var int
     */
    private $created = 0;

    /**
     * @var string
     */
    private $creator = '';

    /**
     * @var bool
     */
    private $isArchived = false;

    /**
     * @var bool
     */
    private $isMpim = false;

    /**
     * @var bool
     */
    private $isGroup = false;


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getCreated(): int
    {
        return $this->created;
    }

    /**
     * @param int $created
     */
    public function setCreated(int $created): void
    {
        $this->created = $created;
    }

    /**
     * @return string
     */
    public function getCreator(): string
    {
        return $this->creator;
    }

    /**
     * @param string $creator
     */
    public function setCreator(string $creator): void
    {
        $this->creator = $creator;
    }

    /**
     * @return bool
     */
    public function getIsArchived(): bool
    {
        return $this->isArchived;
    }

    /**
     * @param bool $isArchived
     */
    public function setIsArchived(bool $isArchived): void
    {
        $this->isArchived = $isArchived;
    }

    /**
     * @return bool
     */
    public function isMpim(): bool
    {
        return $this->isMpim;
    }

    /**
     * @param bool $isMpim
     */
    public function setIsMpim(bool $isMpim): void
    {
        $this->isMpim = $isMpim;
    }

    /**
     * @return bool
     */
    public function getIsGroup(): bool
    {
        return $this->isGroup;
    }

    /**
     * @param bool $isGroup
     */
    public function setIsGroup(bool $isGroup): void
    {
        $this->isGroup = $isGroup;
    }
}
