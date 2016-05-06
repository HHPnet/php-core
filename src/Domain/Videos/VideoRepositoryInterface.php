<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Videos;

interface VideoRepositoryInterface
{
    /**
     * @param HHPnet\Core\Domain\Videos\Video $video
     *
     * @return bool
     */
    public function save(Video $video);

    /**
     * @param HHPnet\Core\Domain\Videos\Video $video
     *
     * @return bool
     */
    public function remove(Video $video);

    /**
     * @param string $video_id
     *
     * @return HHPnet\Core\Domain\Videos\Video
     */
    public function getById($video_id);

    /**
     * @param string $video_service_id
     * @param string $video_service
     *
     * @return HHPnet\Core\Domain\Videos\Video
     */
    public function getByVideoServiceId($video_service_id, $video_service);

    /**
     * @return VideoId
     */
    public function nextIdentity();
}
