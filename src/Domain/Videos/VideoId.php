<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core)
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Domain\Videos;

use Ramsey\Uuid\Uuid;

class VideoId
{
    private $id;

    /**
     * @param string $id
     */
    public function __construct($id = null)
    {
        if (is_null($id) || false === Uuid::isValid($id)) {
            $id = Uuid::uuid4();
        }

        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return (string) $this->id;
    }
}
