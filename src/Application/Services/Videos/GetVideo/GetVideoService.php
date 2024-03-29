<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Videos\GetVideo;

use HHPnet\Core\Domain\Videos\VideoRepositoryInterface;

class GetVideoService
{
    /**
     * @var HHPnet\Core\Domain\Videos\VideoRepositoryInterface
     */
    private $repository;

    /**
     * @param HHPnet\Core\Domain\Videos\VideoRepositoryInterface $repository
     */
    public function __construct(VideoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param HHPnet\Core\Application\Services\Videos\GetVideo\GetVideoRequest $request
     *
     * @return HHPnet\Core\Application\Services\Videos\GetVideo\GetVideoResponse
     */
    public function execute(GetVideoRequest $request)
    {
        return new GetVideoResponse($this->repository->getById($request->videoId()));
    }
}
