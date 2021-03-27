<?php

/*
 * This file is part of the xbhub/ShopDouyin.
 *
 * (c) jory <jorycn@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Xbhub\ShopDouyin\Api\Kernel\Exceptions;

use Throwable;

/**
 * Class ClientError.
 *
 * @author jory <jorycn@163.com>
 */
class ClientError extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if (is_array($message))
        {
            $message= $message['message'];
        }
        parent::__construct($message, $code, $previous);
    }
    
}
