<?php

declare(strict_types=1);

namespace AppTests;

use App\CreateUserCommand;
use App\CreateUserHandler;
use App\Interfaces\MessageBusInterface;
use App\Interfaces\SendUserInvitationDecider;
use App\SendUserInvitationCommand;
use App\User;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\CreateUserHandler
 */
class CreateUserHandlerTest extends TestCase
{
    private MessageBusInterface $messageBus;
    private SendUserInvitationDecider $decider;
    private CreateUserHandler $handler;

    protected function setUp(): void
    {
        $this->messageBus = $this->createMock(MessageBusInterface::class);
        $this->decider = $this->createStub(SendUserInvitationDecider::class);
        $this->handler = new CreateUserHandler($this->messageBus, $this->decider);
    }

    /**
     * @test
     */
    public function it_sends_user_invitation_if_decider_permits()
    {
        $this->decider
            ->method('hasSendInvitationPermission')
            ->willReturn(true);
        
        $user = new User('testName', 'test@test.at');
        $sendUserInvitationCommand = new SendUserInvitationCommand($user);
        
        $this->messageBus
            ->expects($this->once())
            ->method('dispatch')
            ->with($this->equalTo($sendUserInvitationCommand));
        
        $createUserCommand = new CreateUserCommand($user);
        $this->handler->__invoke($createUserCommand);
    }

    /**
     * @test
     */
    public function it_doesnt_sends_user_invitation_if_decider_prohibits()
    {
        $this->decider
            ->method('hasSendInvitationPermission')
            ->willReturn(false);

        $this->messageBus
            ->expects($this->never())
            ->method('dispatch');

        $user = new User('testName', 'test@test.at');
        $createUserCommand = new CreateUserCommand($user);
        $this->handler->__invoke($createUserCommand);
    }

}
