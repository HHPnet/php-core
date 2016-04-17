<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Songs;

use HHPnet\Core\Domain\Albums\AlbumId;

class SaveSongRequest
{
    /**
     * @var HHPnet\Core\Domain\Albums\AlbumId
     */
    private $album_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $path;

    /**
     * @param HHPnet\Core\Domain\Albums\AlbumId $album_id
     * @param string                            $name
     * @param string                            $type
     * @param string                            $path
     */
    public function __construct(AlbumId $album_id, $name, $type, $path)
    {
        $this->album_id = $album_id;
        $this->name = $name;
        $this->type = $type;
        $this->path = $path;
    }

    /**
     * @return HHPnet\Core\Domain\Albums\AlbumId
     */
    public function albumId()
    {
        return $this->album_id;
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
    public function type()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function path()
    {
        return $this->path;
    }
}
