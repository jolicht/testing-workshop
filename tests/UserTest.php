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
    public function it_converts_user_to_string()
    {
        $user = User::create('testName', 'test@test.at');
        $this->assertSame('inactive user testName', (string) $user);
    }
}