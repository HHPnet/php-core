<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Groups;

class GroupFactory
{
    /**
     * @param string $id
     * @param string $name
     * @param string $country
     * @param string $bio
     *
     * @return HHPnet\Core\Domain\Groups\Group
     */
    public function getGroupEntity($id, $name, $country, $bio)
    {
        return new Group(new GroupId($id), $name, $country, $bio);
    }
}
