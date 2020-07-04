<?php

namespace ANovikov\Response\Type;

/**
 * Class Channel
 * @package ANovikov\Response\Type
 */
class Channel
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
     * @var bool
     */
    private $isChannel = false;

    /**
     * @var bool
     */
    private $isGroup = false;

    /**
     * @var bool
     */
    private $isIm = false;

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
    private $isGeneral = false;

    /**
     * @var int
     */
    private $unlinked = 0;

    /**
     * @var string
     */
    private $nameNormalized = '';

    /**
     * @var bool
     */
    private $isReadOnly = false;

    /**
     * @var bool
     */
    private $isShared = false;

    /**
     * @var bool
     */
    private $isExtShared = false;

    /**
     * @var bool
     */
    private $isOrgShared = false;

    /**
     * @var array
     */
    private $pendingShared = [];

    /**
     * @var bool
     */
    private $isPendingExtShared = false;

    /**
     * @var bool
     */
    private $isMember = false;

    /**
     * @var bool
     */
    private $isPrivate = false;

    /**
     * @var bool
     */
    private $isMpim = false;

    /**
     * @var string
     */
    private $lastRead = '';

    /**
     * @var array
     */
    private $topic = [];

    /**
     * @var array
     */
    private $purpose = [];

    /**
     * @var array
     */
    private $previousNames = [];

    /**
     * @var int
     */
    private $numMembers = 0;

    /**
     * @var string
     */
    private $locale = '';

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
     * @return bool
     */
    public function isChannel(): bool
    {
        return $this->isChannel;
    }

    /**
     * @param bool $isChannel
     */
    public function setIsChannel(bool $isChannel): void
    {
        $this->isChannel = $isChannel;
    }

    /**
     * @return bool
     */
    public function isGroup(): bool
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

    /**
     * @return bool
     */
    public function isIm(): bool
    {
        return $this->isIm;
    }

    /**
     * @param bool $isIm
     */
    public function setIsIm(bool $isIm): void
    {
        $this->isIm = $isIm;
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
    public function isArchived(): bool
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
    public function isGeneral(): bool
    {
        return $this->isGeneral;
    }

    /**
     * @param bool $isGeneral
     */
    public function setIsGeneral(bool $isGeneral): void
    {
        $this->isGeneral = $isGeneral;
    }

    /**
     * @return int
     */
    public function getUnlinked(): int
    {
        return $this->unlinked;
    }

    /**
     * @param int $unlinked
     */
    public function setUnlinked(int $unlinked): void
    {
        $this->unlinked = $unlinked;
    }

    /**
     * @return string
     */
    public function getNameNormalized(): string
    {
        return $this->nameNormalized;
    }

    /**
     * @param string $nameNormalized
     */
    public function setNameNormalized(string $nameNormalized): void
    {
        $this->nameNormalized = $nameNormalized;
    }

    /**
     * @return bool
     */
    public function isReadOnly(): bool
    {
        return $this->isReadOnly;
    }

    /**
     * @param bool $isReadOnly
     */
    public function setIsReadOnly(bool $isReadOnly): void
    {
        $this->isReadOnly = $isReadOnly;
    }

    /**
     * @return bool
     */
    public function isShared(): bool
    {
        return $this->isShared;
    }

    /**
     * @param bool $isShared
     */
    public function setIsShared(bool $isShared): void
    {
        $this->isShared = $isShared;
    }

    /**
     * @return bool
     */
    public function isExtShared(): bool
    {
        return $this->isExtShared;
    }

    /**
     * @param bool $isExtShared
     */
    public function setIsExtShared(bool $isExtShared): void
    {
        $this->isExtShared = $isExtShared;
    }

    /**
     * @return bool
     */
    public function isOrgShared(): bool
    {
        return $this->isOrgShared;
    }

    /**
     * @param bool $isOrgShared
     */
    public function setIsOrgShared(bool $isOrgShared): void
    {
        $this->isOrgShared = $isOrgShared;
    }

    /**
     * @return array
     */
    public function getPendingShared(): array
    {
        return $this->pendingShared;
    }

    /**
     * @param array $pendingShared
     */
    public function setPendingShared(array $pendingShared): void
    {
        $this->pendingShared = $pendingShared;
    }

    /**
     * @return bool
     */
    public function isPendingExtShared(): bool
    {
        return $this->isPendingExtShared;
    }

    /**
     * @param bool $isPendingExtShared
     */
    public function setIsPendingExtShared(bool $isPendingExtShared): void
    {
        $this->isPendingExtShared = $isPendingExtShared;
    }

    /**
     * @return bool
     */
    public function isMember(): bool
    {
        return $this->isMember;
    }

    /**
     * @param bool $isMember
     */
    public function setIsMember(bool $isMember): void
    {
        $this->isMember = $isMember;
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this->isPrivate;
    }

    /**
     * @param bool $isPrivate
     */
    public function setIsPrivate(bool $isPrivate): void
    {
        $this->isPrivate = $isPrivate;
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
     * @return string
     */
    public function getLastRead(): string
    {
        return $this->lastRead;
    }

    /**
     * @param string $lastRead
     */
    public function setLastRead(string $lastRead): void
    {
        $this->lastRead = $lastRead;
    }

    /**
     * @return array
     */
    public function getTopic(): array
    {
        return $this->topic;
    }

    /**
     * @param array $topic
     */
    public function setTopic(array $topic): void
    {
        $this->topic = $topic;
    }

    /**
     * @return array
     */
    public function getPurpose(): array
    {
        return $this->purpose;
    }

    /**
     * @param array $purpose
     */
    public function setPurpose(array $purpose): void
    {
        $this->purpose = $purpose;
    }

    /**
     * @return array
     */
    public function getPreviousNames(): array
    {
        return $this->previousNames;
    }

    /**
     * @param array $previousNames
     */
    public function setPreviousNames(array $previousNames): void
    {
        $this->previousNames = $previousNames;
    }

    /**
     * @return int
     */
    public function getNumMembers(): int
    {
        return $this->numMembers;
    }

    /**
     * @param int $numMembers
     */
    public function setNumMembers(int $numMembers): void
    {
        $this->numMembers = $numMembers;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }
}
