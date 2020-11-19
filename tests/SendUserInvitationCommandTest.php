<?php

declare(strict_types=1);

namespace AppTests;

use App\SendUserInvitationCommand;
use App\User;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\SendUserInvitationCommand
 */
final class SendUserInvitationCommandTest extends TestCase
{
    private SendUserInvitationCommand $command;
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User('testName', 'test@test.at');
        $this->command = new SendUserInvitationCommand($this->user);
    }

    /**
     * @test
     */
    public function it_gets_user()
    {
        $this->assertSame($this->user, $this->command->getUser());
    }


}