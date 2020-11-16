<?php

declare(strict_types=1);

namespace App;

class User
{
    private string $name;

    private string $email;

    private bool $active = false;
    
    private ?User $supervisor = null;

    private array $roles = [
        'user_member',
        'tenant_member',
    ];

    public function __construct(string $name, string $email)
    {
        $this->name  = $name;
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function activate(): void
    {
        $this->active = true;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function addRole(string $role)
    {
        $this->roles[] = $role;
    }

    public function getSupervisor(): ?User
    {
        return $this->supervisor;
    }

    public function setSupervisor(?User $supervisor): void
    {
        $this->supervisor = $supervisor;
    }
}