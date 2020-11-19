<?php

declare(strict_types=1);

namespace AppTests;

use App\User;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

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
    public function it_throws_exception_on_invalid_email()
    {
        $this->expectException(InvalidArgumentException::class);
        User::create('testName', 'invalid_email');
    }

}
