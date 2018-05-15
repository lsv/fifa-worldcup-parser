<?php

namespace App\Model;

class Team
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $iso2;

    /**
     * @var string
     */
    private $flag;

    /**
     * @var string
     */
    private $emoji;

    /**
     * @var string
     */
    private $fifaCode;

    /**
     * @var string
     */
    private $emojiString;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getIso2(): string
    {
        return $this->iso2;
    }

    public function setIso2(string $iso2): self
    {
        $this->iso2 = $iso2;
        return $this;
    }

    public function getFlag(): string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): self
    {
        $this->flag = $flag;
        return $this;
    }

    public function getEmoji(): ?string
    {
        return $this->emoji;
    }

    public function setEmoji(string $emoji): self
    {
        $this->emoji = $emoji;
        return $this;
    }

    public function getFifaCode(): string
    {
        return $this->fifaCode;
    }

    public function setFifaCode(string $fifaCode): self
    {
        $this->fifaCode = $fifaCode;
        return $this;
    }

    public function getEmojiString(): string
    {
        return $this->emojiString;
    }

    public function setEmojiString(string $emojiString): self
    {
        $this->emojiString = $emojiString;
        return $this;
    }
}
