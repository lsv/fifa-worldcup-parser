<?php

namespace App\Model;

class KnockoutRounds
{
    /**
     * @var KnockoutRound[]
     */
    private $knockoutRounds;

    /**
     * @return KnockoutRound[]
     */
    public function getKnockoutRounds(): array
    {
        $rounds = $this->knockoutRounds;
        usort($rounds, function (KnockoutRound $a, KnockoutRound $b) {
            return $a->getSorting() <=> $b->getSorting();
        });
        return $rounds;
    }

    public function addKnockoutRound(KnockoutRound $round): self
    {
        $this->knockoutRounds[] = $round;
        return $this;
    }
}
