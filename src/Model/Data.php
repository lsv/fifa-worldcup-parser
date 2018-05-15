<?php

namespace App\Model;

class Data
{
    /**
     * @var Stadium[]
     */
    private $stadiums;

    /**
     * @var TvChannel[]
     */
    private $tvchannels;

    /**
     * @var Team[]
     */
    private $teams;

    /**
     * @var Groups
     */
    private $groups;

    /**
     * @var KnockoutRounds
     */
    private $knockoutRounds;

    /**
     * @return Stadium[]
     */
    public function getStadiums(): array
    {
        return $this->stadiums;
    }

    /**
     * @param Stadium[] $stadiums
     *
     * @return $this
     */
    public function setStadiums(array $stadiums): self
    {
        $this->stadiums = $stadiums;
        return $this;
    }

    public function findStadiumById(int $id): Stadium
    {
        foreach ($this->getStadiums() as $stadium) {
            if ($stadium->getId() === $id) {
                return $stadium;
            }
        }

        throw new \InvalidArgumentException('Stadium with id "' . $id . '" not found');
    }

    /**
     * @return TvChannel[]
     */
    public function getTvchannels(): array
    {
        return $this->tvchannels;
    }

    /**
     * @param TvChannel[] $tvchannels
     *
     * @return $this
     */
    public function setTvchannels(array $tvchannels): self
    {
        $this->tvchannels = $tvchannels;
        return $this;
    }

    public function findTvChannelById(int $id): TvChannel
    {
        foreach ($this->getTvchannels() as $channel) {
            if ($channel->getId() === $id) {
                return $channel;
            }
        }

        throw new \InvalidArgumentException('TvChannel with id "' . $id . '" not found');
    }

    /**
     * @return Team[]
     */
    public function getTeams(): array
    {
        return $this->teams;
    }

    /**
     * @param Team[] $teams
     *
     * @return $this
     */
    public function setTeams(array $teams): self
    {
        $this->teams = $teams;
        return $this;
    }

    public function findTeamById(int $id): Team
    {
        foreach ($this->getTeams() as $team) {
            if ($team->getId() === $id) {
                return $team;
            }
        }

        throw new \InvalidArgumentException('Team with id "' . $id . '" not found');
    }

    /**
     * @return Groups
     */
    public function getGroups(): Groups
    {
        return $this->groups;
    }

    /**
     * @param Groups $groups
     *
     * @return $this
     */
    public function setGroups(Groups $groups): self
    {
        $this->groups = $groups;
        return $this;
    }

    /**
     * @return KnockoutRounds
     */
    public function getKnockoutRounds(): KnockoutRounds
    {
        return $this->knockoutRounds;
    }

    /**
     * @param KnockoutRounds $knockoutRounds
     *
     * @return $this
     */
    public function setKnockoutRounds(KnockoutRounds $knockoutRounds): self
    {
        $this->knockoutRounds = $knockoutRounds;
        return $this;
    }
}
