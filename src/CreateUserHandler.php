<?php

declare(strict_types=1);

namespace App;

use App\Interfaces\MessageBusInterface;
use App\Interfaces\SendUserInvitationDecider;

final class CreateUserHandler
{
    private MessageBusInterface $messageBus;

    private SendUserInvitationDecider $sendUserInvitationDecider;

    public function __construct(MessageBusInterface $messageBus, SendUserInvitationDecider $sendUserInvitationDecider)
    {
        $this->messageBus                = $messageBus;
        $this->sendUserInvitationDecider = $sendUserInvitationDecider;
    }

    public function __invoke(CreateUserCommand $command)
    {
        // Does something to create user ...

        $user = $command->getUser();
        if ($this->sendUserInvitationDecider->hasSendInvitationPermission($user)) {
            $this->messageBus->dispatch(new SendUserInvitationCommand($user));
        }
    }

}