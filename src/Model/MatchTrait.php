<?php

namespace Lsv\FifaWorldcupParser\Model;

trait MatchTrait
{
    /**
     * @var int
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var Team|string
     */
    private $homeTeam;

    /**
     * @var Team|string
     */
    private $awayTeam;

    /**
     * @var int|null
     */
    private $homeResult;

    /**
     * @var int|null
     */
    private $awayResult;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var Stadium
     */
    private $stadium;

    /**
     * @var TvChannel[]
     */
    private $channels = [];

    /**
     * @var int
     */
    private $matchday;

    /**
     * @var bool
     */
    private $finished;

    public function getName(): int
    {
        return $this->name;
    }

    public function setName(int $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Team|string
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * @param Team|string $homeTeam
     *
     * @return $this
     */
    public function setHomeTeam($homeTeam): self
    {
        $this->homeTeam = $homeTeam;
        return $this;
    }

    /**
     * @return Team|string
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * @param Team|string $awayTeam
     *
     * @return $this
     */
    public function setAwayTeam($awayTeam): self
    {
        $this->awayTeam = $awayTeam;
        return $this;
    }

    public function getHomeResult(): ?int
    {
        return $this->homeResult;
    }

    public function setHomeResult(?int $homeResult): self
    {
        $this->homeResult = $homeResult;
        return $this;
    }

    public function getAwayResult(): ?int
    {
        return $this->awayResult;
    }

    public function setAwayResult(?int $awayResult): self
    {
        $this->awayResult = $awayResult;
        return $this;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getStadium(): Stadium
    {
        return $this->stadium;
    }

    public function setStadium(Stadium $stadium): self
    {
        $this->stadium = $stadium;
        return $this;
    }

    /**
     * @return TvChannel[]
     */
    public function getChannels(): array
    {
        return $this->channels;
    }

    /**
     * @param TvChannel[] $channels
     *
     * @return $this
     */
    public function setChannels(array $channels): self
    {
        $this->channels = $channels;
        return $this;
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }

    public function setFinished(bool $finished): self
    {
        $this->finished = $finished;
        return $this;
    }

    public function getMatchday(): int
    {
        return $this->matchday;
    }

    public function setMatchday(int $matchday): self
    {
        $this->matchday = $matchday;
        return $this;
    }

    /**
     * @param Team|string $team
     *
     * @return string
     */
    public function getSlackName($team): string
    {
        if ($team instanceof Team) {
            if ($team->getEmoji()) {
                return sprintf(':%s: %s', $team->getEmoji(), $team->getName());
            }

            return $team->getName();
        }

        return $team;
    }
}
