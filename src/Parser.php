<?php

namespace Lsv\FifaWorldcupParser;

use Lsv\FifaWorldcupParser\Model;

class Parser
{
    private const DEFAULT = 'https://raw.githubusercontent.com/lsv/fifa-worldcup-2018/master/data.json';

    /**
     * @var string
     */
    private $data;

    /**
     * @var array
     */
    private $dataArray;

    public function __construct(string $data = null)
    {
        $this->data = $data ?: file_get_contents(self::DEFAULT);
    }

    public function parse(): Model\Data
    {
        $this->dataArray = json_decode($this->data, true);
        $data = (new Model\Data())
            ->setStadiums($this->parseStadiums())
            ->setTvchannels($this->parseTvChannels())
            ->setTeams($this->parseTeams())
        ;
        $data->setGroups($this->parseGroups($data));
        $data->setKnockoutRounds($this->parseKnockouts($data));

        return $data;
    }

    /**
     * @return Model\Stadium[]
     */
    protected function parseStadiums(): array
    {
        return $this->buildObjects($this->dataArray['stadiums'], Model\Stadium::class);
    }

    /**
     * @return Model\TvChannel[]
     */
    protected function parseTvChannels(): array
    {
        return $this->buildObjects($this->dataArray['tvchannels'], Model\TvChannel::class);
    }

    /**
     * @return Model\Team[]
     */
    protected function parseTeams(): array
    {
        return $this->buildObjects($this->dataArray['teams'], Model\Team::class);
    }

    protected function parseGroups(Model\Data $data): array
    {
        $groups = [];
        $sorting = 0;
        foreach ((array) $this->dataArray['groups'] as $id => $value) {
            $groups[] = (new Model\Group())
                ->setId($id)
                ->setName($value['name'])
                ->setSorting(++$sorting)
                ->setWinner($value['winner'] ? $data->findTeamById($value['winner']) : null)
                ->setRunnerup($value['runnerup'] ? $data->findTeamById($value['runnerup']) : null)
                ->setMatches($this->buildMatches($data, $value['matches'], Model\GroupMatch::class))
            ;
        }
        return $groups;
    }

    protected function parseKnockouts(Model\Data $data): array
    {
        $rounds = [];
        $sorting = 0;
        foreach ((array) $this->dataArray['knockout'] as $id => $value) {
            $rounds[] = (new Model\KnockoutRound())
                ->setId($id)
                ->setSorting(++$sorting)
                ->setName($value['name'])
                ->setMatches($this->buildMatches($data, $value['matches'], Model\KnockoutMatch::class, true))
            ;
        }

        return $rounds;
    }

    /**
     * @param Model\Data $data
     * @param array $matches
     * @param string $className
     * @param bool $knockout
     *
     * @return Model\GroupMatch[]|Model\KnockoutMatch[]
     */
    private function buildMatches(Model\Data $data, array $matches, string $className, $knockout = false): array
    {
        $setters = [
            'channels' => function ($value) use ($data) {
                return array_map(function ($channel) use ($data) {
                    return $data->findTvChannelById($channel);
                }, $value);
            },
            'home_team' => function ($value) use ($data, $knockout) {
                if ($knockout && (!\is_int($value) || $value > 32)) {
                    return $value;
                }
                return $data->findTeamById($value);
            },
            'away_team' => function ($value) use ($data, $knockout) {
                if ($knockout && (!\is_int($value) || $value > 32)) {
                    return $value;
                }
                return $data->findTeamById($value);
            },
            'stadium' => function ($value) use ($data) {
                return $data->findStadiumById($value);
            },
            'date' => function ($value) {
                return new \DateTime($value);
            },
            'winner' => function ($value) use ($data) {
                return \is_int($value) ? $data->findTeamById($value) : $value;
            }
        ];
        return $this->buildObjects($matches, $className, $setters);
    }

    /**
     * @param array $data
     * @param string $className
     * @param array $setters
     *
     * @return array
     */
    private function buildObjects(array $data, string $className, array $setters = []): array
    {
        $objects = [];
        foreach ($data as $datum) {
            $object = new $className();

            foreach ((array)$datum as $key => $value) {
                $setter = 'set' . str_replace(' ', '', ucfirst(str_replace('_', ' ', $key)));
                if (!method_exists($object, $setter)) {
                    throw new \InvalidArgumentException('Setter "' . $setter . '" not found in object "' . $className . '"');
                }

                $data = isset($setters[$key]) && \is_callable($setters[$key]) ? \call_user_func($setters[$key], $value) : $value;
                $object->{$setter}($data);
            }
            $objects[] = $object;
        }
        return $objects;
    }
}
