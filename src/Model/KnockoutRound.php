<?php

namespace Lsv\FifaWorldcupParser\Model;

class KnockoutRound
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var KnockoutMatch[]
     */
    private $matches;

    /**
     * @var int
     */
    private $sorting;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
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

    /**
     * @return KnockoutMatch[]
     */
    public function getMatches(): array
    {
        return $this->matches;
    }

    /**
     * @param KnockoutMatch[] $matches
     *
     * @return $this
     */
    public function setMatches(array $matches): self
    {
        foreach ($matches as &$match) {
            $match->setKnockoutRound($this);
        }
        unset($match);
        $this->matches = $matches;
        return $this;
    }

    public function getSorting(): int
    {
        return $this->sorting;
    }

    public function setSorting(int $sorting): self
    {
        $this->sorting = $sorting;
        return $this;
    }
}
