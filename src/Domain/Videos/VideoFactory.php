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
    /**
     * @param  string                          $id
     * @param  string                          $video_service_id
     * @param  string                          $video_service
     * @param  string                          $title
     * @param  string                          $description
     * @return HHPnet\Core\Domain\Videos\Video
     */
    public function getVideoEntity($id, $video_service_id, $video_service, $title, $description)
    {
        return new Video(new VideoId($id), $video_service_id, $video_service, $title, $description);
    }
}
