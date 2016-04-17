<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Groups;

class GetGroupRequest
{
    /**
     * @var string
     */
    private $group_id;

    /**
     * @param string $group_id
     */
    public function __construct($group_id)
    {
        $this->group_id = $group_id;
    }

    /**
     * @return string
     */
    public function groupId()
    {
        return $this->group_id;
    }
}
