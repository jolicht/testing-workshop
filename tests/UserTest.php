<?php

declare(strict_types=1);

namespace AppTests;

use App\User;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\User
 */
final class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User('testName', 'test@test.at');
    }

    /**
     * @test
     */
    public function it_gets_name()
    {
        $this->assertSame('testName', $this->user->getName());
    }

    /**
     * @test
     */
    public function it_gets_email()
    {
        $this->assertSame('test@test.at', $this->user->getEmail());
    }

    /**
     * @test
     */
    public function it_is_not_active_by_default()
    {
        $this->assertFalse($this->user->isActive());
    }

    /**
     * @test
     */
    public function it_activates()
    {
        $this->user->activate();
        $this->assertTrue($this->user->isActive());
    }

    /**
     * @test
     */
    public function it_gets_default_roles()
    {
        $roles = $this->user->getRoles();
        $this->assertIsArray($roles);
        $this->assertCount(2, $roles);
        $this->assertContains('user_member', $roles);
        $this->assertContains('tenant_member', $roles);
    }

    /**
     * @test
     */
    public function it_adds_role()
    {
        $this->user->addRole('testRole');
        $roles = $this->user->getRoles();
        $this->assertCount(3, $roles);
        $this->assertContains('testRole', $roles);
    }

    /**
     * @test
     */
    public function it_gets_supervisor_default_null()
    {
        $this->assertNull($this->user->getSupervisor());
    }

    /**
     * @test
     */
    public function it_sets_supervisor()
    {
        $supervisor = new User('supervisor', 'supervisor@test.at');
        $this->user->setSupervisor($supervisor);
        $this->assertSame($supervisor, $this->user->getSupervisor());
    }
}