<?php

namespace Lsv\FifaWorldcupParser\Model;

class GroupMatch implements MatchInterface
{
    use MatchTrait;

    /**
     * @var Group
     */
    private $group;

    public function getGroup(): Group
    {
        return $this->group;
    }

    public function setGroup(Group $group): self
    {
        $this->group = $group;
        return $this;
    }
}
