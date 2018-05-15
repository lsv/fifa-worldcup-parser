<?php

namespace Lsv\FifaWorldcupParser\Model;

interface MatchInterface
{
    public function getName(): int;

    public function getType(): string;

    /**
     * @return Team|string
     */
    public function getHomeTeam();

    /**
     * @return Team|string
     */
    public function getAwayTeam();

    public function getHomeResult(): ?int;

    public function getAwayResult(): ?int;

    public function getDate(): \DateTime;

    public function getStadium(): Stadium;

    /**
     * @return TvChannel[]
     */
    public function getChannels(): array;

    public function isFinished(): bool;

    /**
     * @param Team|string $team
     *
     * @return string
     */
    public function getSlackName($team): string;
}
