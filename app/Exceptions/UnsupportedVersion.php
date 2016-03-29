<?php

namespace App\Exceptions;

use Illuminate\Http\Response;
use RuntimeException;

class UnsupportedVersion extends RuntimeException
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = ["error" => "Unsupported version"];
}
