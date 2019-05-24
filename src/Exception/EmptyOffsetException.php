<?php

namespace Dummy\Server\Exception;

use Throwable;

class EmptyOffsetException extends \Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Offset cannot be null', 500, $previous);
    }
}