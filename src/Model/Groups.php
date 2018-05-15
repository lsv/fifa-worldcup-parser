<?php

namespace Lsv\FifaWorldcupParser\Model;

class Groups
{
    /**
     * @var Group[]
     */
    private $groups;

    /**
     * @return Group[]
     */
    public function getGroups(): array
    {
        $groups = $this->groups;
        usort($groups, function (Group $a, Group $b) {
            return strcmp($a->getName(), $b->getName());
        });
        return $groups;
    }

    public function addGroup(Group $group): self
    {
        $this->groups[] = $group;
        return $this;
    }
}
