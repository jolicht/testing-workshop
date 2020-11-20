<?php

namespace spec\App;

use App\User;
use PhpSpec\ObjectBehavior;

class UserSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('testName', 'test@test.at');
    }
    
    function it_is_initializable()
    {
        
        $this->shouldHaveType(User::class);
    }
    
    function it_gets_name()
    {
        $this->getName()->shouldBe('testName');
    }
    
    function it_gets_email()
    {
        $this->getEmail()->shouldBe('test@test.at');
    }
}
