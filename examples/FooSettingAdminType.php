<?php

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FooSettingAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('bar');
        $builder->add('fooVariant', 'choice', [
            'choices' => [
                'some option' => 'some value'
            ]
        ]);
    }
}
