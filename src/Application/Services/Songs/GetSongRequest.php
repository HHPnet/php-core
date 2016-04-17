<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Songs;

class GetSongRequest
{
    /**
     * @var string
     */
    private $song_id;

    /**
     * @param string $song_id
     */
    public function __construct($song_id)
    {
        $this->song_id = $song_id;
    }

    /**
     * @return string
     */
    public function songId()
    {
        return $this->song_id;
    }
}
