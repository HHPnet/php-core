<?php

/**
 * This file is part of the HHPNet/Core (https://github.com/HHPnet/core).
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace HHPnet\Core\Application\Services\Users\NewPassword;

use HHPnet\Core\Application\Services\Users\SharedResponse;

class NewPasswordResponse extends SharedResponse
{
    /**
     * @return string
     */
    public function password()
    {
        return $this->user->getPassword();
    }
}
