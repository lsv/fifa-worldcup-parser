<?php

namespace App\Model;

class KnockoutMatch implements MatchInterface
{
    use MatchTrait;

    /**
     * @var int|null
     */
    private $homePenalty;

    /**
     * @var int|null
     */
    private $awayPenalty;

    /**
     * @var string|null
     */
    private $winner;

    /**
     * @var KnockoutRound
     */
    private $knockoutRound;

    public function getHomePenalty(): ?int
    {
        return $this->homePenalty;
    }

    public function setHomePenalty(?int $homePenalty): self
    {
        $this->homePenalty = $homePenalty;
        return $this;
    }

    public function getAwayPenalty(): ?int
    {
        return $this->awayPenalty;
    }

    public function setAwayPenalty(?int $awayPenalty): self
    {
        $this->awayPenalty = $awayPenalty;
        return $this;
    }

    public function getWinner(): ?string
    {
        return $this->winner;
    }

    public function setWinner(?string $winner): self
    {
        $this->winner = $winner;
        return $this;
    }

    public function getKnockoutRound(): KnockoutRound
    {
        return $this->knockoutRound;
    }

    public function setKnockoutRound(KnockoutRound $knockoutRound): self
    {
        $this->knockoutRound = $knockoutRound;
        return $this;
    }
}
