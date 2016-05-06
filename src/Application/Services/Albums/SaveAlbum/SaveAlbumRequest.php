<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Albums\SaveAlbum;

use HHPnet\Core\Domain\Groups\GroupId;

class SaveAlbumRequest
{
    /**
     * @var HHPnet\Core\Domain\Groups\GroupId
     */
    private $group_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $release_year;

    /**
     * @param HHPnet\Core\Domain\Groups\GroupId $group_id
     * @param string                            $name
     * @param string                            $description
     * @param int                               $release_year
     */
    public function __construct(GroupId $group_id, $name, $description, $release_year)
    {
        $this->group_id = $group_id;
        $this->name = $name;
        $this->description = $description;
        $this->release_year = $release_year;
    }

    /**
     * @return HHPnet\Core\Domain\Groups\GroupId
     */
    public function groupId()
    {
        return $this->group_id;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function releaseYear()
    {
        return $this->release_year;
    }
}
