<?php

namespace spec\Pim\Bundle\CatalogBundle\Validator\Constraints;

use PhpSpec\ObjectBehavior;

class UniqueValueSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Pim\Bundle\CatalogBundle\Validator\Constraints\UniqueValue');
    }

    function it_has_message()
    {
        $this->message->shouldBe('This value is already set on another product.');
    }

    function it_is_a_validator_constraint()
    {
        $this->shouldBeAnInstanceOf('Symfony\Component\Validator\Constraint');
    }
}
