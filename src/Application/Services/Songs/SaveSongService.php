<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Songs;

use HHPnet\Core\Domain\Songs\SongRepositoryInterface;
use HHPnet\Core\Domain\Songs\SongFactory;

class SaveSongService
{
    /**
     * @var HHPnet\Core\Domain\Songs\SongRepositoryInterface
     */
    private $repository;

    /**
     * @var HHPnet\Core\Domain\Songs\SongFactory
     */
    private $factory;

    /**
     * @param HHPnet\Core\Domain\Songs\SongRepositoryInterface $repository
     * @param HHPnet\Core\Domain\Songs\SongFactory             $factory
     */
    public function __construct(SongRepositoryInterface $repository, SongFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @param HHPnet\Core\Application\Services\Songs\SaveSongRequest $request
     *
     * @return HHPnet\Core\Application\Services\Songs\SaveSongResponse
     */
    public function execute(SaveSongRequest $request)
    {
        try {
            $this->repository->getBySongByName($request->albumId(), $request->name());
            throw new \DomainException('Given song has been registered in our database');
        } catch (\UnexpectedValueException $e) {
        }

        $song = $this->repository->save(
            $this->factory->getSongEntity(
                null,
                $request->albumId(),
                $request->name(),
                $request->type(),
                $request->path()
            )
        );

        return new SaveSongResponse($song);
    }
}
