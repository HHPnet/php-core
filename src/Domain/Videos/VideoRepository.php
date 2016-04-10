<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core)
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Videos;

interface VideoRepository
{
    /**
     * @param  Video    $video
     * @return boolean
     */
    public function save(Video $video);

    /**
     * @param  Video    $video
     * @return boolean
     */
    public function remove(Video $video);

    /**
     * @param  string $video_id
     * @return Video
     */
    public function getById($video_id);

    /**
     * @param  string $video_service_id
     * @param string $video_service
     * @return Video
     */
    public function getBygetVideoServiceId($video_service_id, $video_service);
}
