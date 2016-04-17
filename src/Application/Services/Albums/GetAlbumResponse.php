<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Albums;

use HHPnet\Core\Domain\Albums\Album;

class GetAlbumResponse
{
    /**
     * @var HHPnet\Core\Domain\Albums\Album
     */
    private $album;

    /**
     * @param HHPnet\Core\Domain\Albums\Album $album
     */
    public function __construct(Album $album)
    {
        $this->album = $album;
    }

    /**
     * @return string
     */
    public function albumId()
    {
        return (string) $this->album->getId();
    }

    /**
     * @return string
     */
    public function groupId()
    {
        return (string) $this->album->getGroupId();
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->album->getName();
    }

    /**
     * @return string
     */
    public function description()
    {
        return $this->album->getDescription();
    }

    /**
     * @return int
     */
    public function releaseYear()
    {
        return $this->album->getReleaseYear();
    }
}
