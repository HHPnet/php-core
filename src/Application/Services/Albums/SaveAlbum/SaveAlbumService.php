<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Albums\SaveAlbum;

use HHPnet\Core\Domain\Albums\AlbumRepositoryInterface;
use HHPnet\Core\Domain\Albums\AlbumFactory;

class SaveAlbumService
{
    /**
     * @var HHPnet\Core\Domain\Albums\AlbumRepositoryInterface
     */
    private $repository;

    /**
     * @var HHPnet\Core\Domain\Albums\AlbumFactory
     */
    private $factory;

    /**
     * @param HHPnet\Core\Domain\Albums\AlbumRepositoryInterface $repository
     * @param HHPnet\Core\Domain\Albums\AlbumFactory             $factory
     */
    public function __construct(AlbumRepositoryInterface $repository, AlbumFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @param HHPnet\Core\Application\Services\Albums\SaveAlbumRequest $request
     *
     * @return HHPnet\Core\Application\Services\Albums\SaveAlbumResponse
     */
    public function execute(SaveAlbumRequest $request)
    {
        try {
            $this->repository->getAlbumByName($request->groupId(), $request->name());
            throw new \DomainException('Given album has been registered in our database');
        } catch (\UnexpectedValueException $e) {
        }

        $album = $this->repository->save(
            $this->factory->getAlbumEntity(
                null,
                $request->groupId(),
                $request->name(),
                $request->description(),
                $request->releaseYear()
            )
        );

        return new SaveAlbumResponse($album);
    }
}
