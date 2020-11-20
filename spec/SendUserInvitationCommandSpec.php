<?php

namespace spec\App;

use App\SendUserInvitationCommand;
use App\User;
use PhpSpec\ObjectBehavior;

class SendUserInvitationCommandSpec extends ObjectBehavior
{
    private User $user;

    function let()
    {
        $this->user = new User('testName', 'test@test.at');
        $this->beConstructedWith($this->user);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType(SendUserInvitationCommand::class);
    }

    function it_gets_user()
    {
        $this->getUser()->shouldBe($this->user);
    }
}
