<?php

namespace Lsv\FifaWorldcupParser\Model;

class Group
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
     * @var Team|null
     */
    private $winner;

    /**
     * @var Team|null
     */
    private $runnerup;

    /**
     * @var GroupMatch[]
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

    public function getWinner(): ?Team
    {
        return $this->winner;
    }

    public function setWinner(?Team $winner): self
    {
        $this->winner = $winner;
        return $this;
    }

    public function getRunnerup(): ?Team
    {
        return $this->runnerup;
    }

    public function setRunnerup(?Team $runnerup): self
    {
        $this->runnerup = $runnerup;
        return $this;
    }

    /**
     * @return GroupMatch[]
     */
    public function getMatches(): array
    {
        return $this->matches;
    }

    /**
     * @param GroupMatch[] $matches
     *
     * @return $this
     */
    public function setMatches(array $matches): self
    {
        foreach ($matches as &$match) {
            $match->setGroup($this);
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
