<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Videos;

class GetVideoRequest
{
    /**
     * @var string
     */
    private $video_id;

    /**
     * @param string $video_id
     */
    public function __construct($video_id)
    {
        $this->video_id = $video_id;
    }

    /**
     * @return string
     */
    public function videoId()
    {
        return $this->video_id;
    }
}
