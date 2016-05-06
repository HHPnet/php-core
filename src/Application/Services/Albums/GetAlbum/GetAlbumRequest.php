<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Albums\GetAlbum;

class GetAlbumRequest
{
    /**
     * @var string
     */
    private $album_id;

    /**
     * @param string $album_id
     */
    public function __construct($album_id)
    {
        $this->album_id = $album_id;
    }

    /**
     * @return string
     */
    public function albumId()
    {
        return $this->album_id;
    }
}
