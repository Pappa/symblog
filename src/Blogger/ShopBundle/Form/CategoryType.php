<?php

namespace Blogger\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('tags')
        ;
    }

    public function getName()
    {
        return 'blogger_shopbundle_categorytype';
    }
}
