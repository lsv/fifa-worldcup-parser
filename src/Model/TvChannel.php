<?php

namespace Lsv\FifaWorldcupParser\Model;

class TvChannel
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
     * @var string|null
     */
    private $icon;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $iso2;

    /**
     * @var string[]
     */
    private $lang;

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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;
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

    /**
     * @return string[]
     */
    public function getLang(): array
    {
        return $this->lang;
    }

    /**
     * @param string[] $lang
     *
     * @return $this
     */
    public function setLang(array $lang): self
    {
        $this->lang = $lang;
        return $this;
    }
}
