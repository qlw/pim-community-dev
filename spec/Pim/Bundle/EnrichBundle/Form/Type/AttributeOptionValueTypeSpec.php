<?php

namespace spec\Pim\Bundle\EnrichBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AttributeOptionValueTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Pim\Bundle\CatalogBundle\Entity\AttributeOptionValue');
    }

    function it_is_a_form_type()
    {
        $this->shouldBeAnInstanceOf('Symfony\Component\Form\AbstractType');
    }

    function it_has_a_name()
    {
        $this->getName()->shouldReturn('pim_enrich_attribute_option_value');
    }

    function it_builds_form(FormBuilderInterface $builder)
    {
        $builder->add('id', 'hidden')->shouldBeCalled();

        $builder->add('locale', 'hidden')->shouldBeCalled();

        $builder->add('value', null, ['required' => false])->shouldBeCalled();

        $this->buildForm($builder, []);
    }

    function it_sets_default_option(OptionsResolverInterface $resolver)
    {
        $this->setDefaultOptions($resolver, []);

        $resolver->setDefaults(
            [
                'data_class' => 'Pim\Bundle\CatalogBundle\Entity\AttributeOptionValue',
            ]
        )->shouldHaveBeenCalled();
    }
}
