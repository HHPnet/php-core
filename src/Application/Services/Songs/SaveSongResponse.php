<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Songs;

use HHPnet\Core\Domain\Songs\Song;

class SaveSongResponse
{
    /**
     * @var HHPnet\Core\Domain\Songs\Song
     */
    private $song;

    /**
     * @param HHPnet\Core\Domain\Songs\Song $song
     */
    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    /**
     * @return string
     */
    public function songId()
    {
        return (string) $this->song->getId();
    }

    /**
     * @return string
     */
    public function albumId()
    {
        return (string) $this->song->getAlbumId();
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->song->getName();
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->song->getType();
    }

    /**
     * @return string
     */
    public function path()
    {
        return $this->song->getPath();
    }
}
