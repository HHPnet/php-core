<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core)
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Videos;

use HHPnet\Core\Domain\Videos\VideoRepository;

class GetVideoService
{
    /**
     * @var HHPnet\Core\Domain\Videos\VideoRepository
     */
    private $repository;

    /**
     * @param HHPnet\Core\Domain\Videos\VideoRepository $repository
     */
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  HHPnet\Core\Application\Services\Videos\GetVideoRequest  $request
     * @return HHPnet\Core\Application\Services\Videos\GetVideoResponse
     */
    public function execute(GetVideoRequest $request)
    {
        return new GetVideoResponse($this->repository->getById($request->id()));
    }
}
