<?php

declare(strict_types=1);

namespace App;

use Webmozart\Assert\Assert;

final class User
{
    private string $name;
    
    private string $email;

    private function __construct(string $name, string $email)
    {
        $this->name  = $name;
        $this->email = $email;
    }

    public static function create(string $name, string $email)
    {
        Assert::email($email);
        return new self($name, $email);
    }

}