<?php

declare(strict_types=1);

namespace AppTests;

use App\CreateUserCommand;
use App\User;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\CreateUserCommand
 */
final class CreateUserCommandTest extends TestCase
{
    private CreateUserCommand $command;
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User('testName', 'test@test.at');
        $this->command = new CreateUserCommand($this->user);
    }

    /**
     * @test
     */
    public function it_gets_user()
    {
        $this->assertSame($this->user, $this->command->getUser());
    }


}