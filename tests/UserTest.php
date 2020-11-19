<?php

declare(strict_types=1);

namespace AppTests;

use App\User;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\User
 */
class UserTest extends TestCase
{
    private User $user;
    
    protected function setUp(): void
    {
        $this->user = User::create('testName', 'test@test.at');
    }
    
    /**
     * @test
     */
    public function it_creates_user()
    {
        $this->assertInstanceOf(User::class, User::create('testName', 'test@test.at'));
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
    public function it_converts_inactive_user_to_string()
    {
        $this->assertSame('inactive user testName', (string) $this->user);
    }

    /**
     * @test
     */
    public function it_converts_active_user_to_string()
    {
        $this->user->activate();
        $this->assertSame('active user testName', (string) $this->user);
    }

}