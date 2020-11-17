<?php
declare(strict_types=1);

namespace App\Api\Exception;

final class AuthenticationException extends \RuntimeException
{
    public static function missing(): self
    {
        return new self('Token missing');
    }

    public static function invalid(): self
    {
        return new self('Token invalid');
    }
}
