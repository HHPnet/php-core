<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Groups;

use HHPnet\Core\Domain\Groups\Group;

abstract class SharedResponse
{
    /**
     * @var HHPnet\Core\Domain\Groups\Group
     */
    protected $group;

    /**
     * @param HHPnet\Core\Domain\Groups\Group $group
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function groupId()
    {
        return (string) $this->group->getId();
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->group->getName();
    }

    /**
     * @return string
     */
    public function country()
    {
        return $this->group->getCountry();
    }

    /**
     * @return string
     */
    public function bio()
    {
        return $this->group->getBio();
    }
}
