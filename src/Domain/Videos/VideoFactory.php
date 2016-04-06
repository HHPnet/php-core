<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core)
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Videos;

class VideoFactory
{
    public function getVideoEntity($id, $video_service_id, $video_service, $title, $description)
    {
        return new Video(new VideoId($id), $video_service_id, $video_service, $title, $description);
    }
}
