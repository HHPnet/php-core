<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core)
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Videos;

use HHPnet\Core\Domain\Videos\Video;

class GetVideoResponse
{
    /**
     * @var HHPnet\Core\Domain\Videos\Video
     */
    private $video;

    /**
     * @param HHPnet\Core\Domain\Videos\Video $video
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->video->getId();
    }

    /**
     * @return string
     */
    public function videoServiceId()
    {
        return $this->video->getVideoServiceId();
    }

    /**
     * @return string
     */
    public function videoService()
    {
        return $this->video->getVideoService();
    }

    /**
     * @return string
     */
    public function title()
    {
        return $this->video->getTitle();
    }

    /**
     * @return string
     */
    public function description()
    {
        return $this->video->getDescription();
    }
}
