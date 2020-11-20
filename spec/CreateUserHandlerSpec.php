<?php

namespace spec\App;

use App\CreateUserCommand;
use App\CreateUserHandler;
use App\Interfaces\MessageBusInterface;
use App\Interfaces\SendUserInvitationDecider;
use App\SendUserInvitationCommand;
use App\User;
use PhpSpec\ObjectBehavior;

class CreateUserHandlerSpec extends ObjectBehavior
{
    function it_is_initializable(MessageBusInterface $messageBus, SendUserInvitationDecider $sendUserInvitationDecider)
    {
        $this->beConstructedWith($messageBus, $sendUserInvitationDecider);
        $this->shouldHaveType(CreateUserHandler::class);
    }

    function it_sends_user_invitation_on_decider_permission(
        MessageBusInterface $messageBus,
        SendUserInvitationDecider $sendUserInvitationDecider
    ) {
        $this->beConstructedWith($messageBus, $sendUserInvitationDecider);
        $user = new User('testName', 'test@test.at');

        $sendUserInvitationDecider->hasSendInvitationPermission($user)->willReturn(true);
        
        $sendUserInvitationCommand = new SendUserInvitationCommand($user);
        $messageBus->dispatch($sendUserInvitationCommand)->shouldBeCalledOnce();
                
        $createUserCommand = new CreateUserCommand($user);
        
        $this->__invoke($createUserCommand);
    }

    function it_does_not_send_user_invitation_on_decider_prohibition(
        MessageBusInterface $messageBus,
        SendUserInvitationDecider $sendUserInvitationDecider
    ) {
        $this->beConstructedWith($messageBus, $sendUserInvitationDecider);
        $user = new User('testName', 'test@test.at');

        $sendUserInvitationDecider->hasSendInvitationPermission($user)->willReturn(false);
        
        $messageBus->dispatch()->shouldNotBeCalled();

        $createUserCommand = new CreateUserCommand($user);

        $this->__invoke($createUserCommand);
    }
}

