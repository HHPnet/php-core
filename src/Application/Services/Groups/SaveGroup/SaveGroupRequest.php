<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Groups\SaveGroup;

class SaveGroupRequest
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $bio;

    /**
     * @param string $name
     * @param string $country
     * @param string $bio
     */
    public function __construct($name, $country, $bio)
    {
        $this->name = $name;
        $this->country = $country;
        $this->bio = $bio;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function country()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function bio()
    {
        return $this->bio;
    }
}
