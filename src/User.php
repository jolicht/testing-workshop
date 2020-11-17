<?php

declare(strict_types=1);

namespace App;

use Webmozart\Assert\Assert;

final class User
{
    private string $name;
    
    private string $email;
    
    private bool $active = false;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function activate()
    {
        $this->active = true;
    }
    
    public function __toString()
    {
        return ($this->active ? 'active' : 'inactive') . ' user ' . $this->name;
    }
}