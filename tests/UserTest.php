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


}