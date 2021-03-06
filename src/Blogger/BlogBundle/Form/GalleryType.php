<?php

namespace Blogger\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GalleryType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('images','file',array(
            "label" => "Images",
            "required" => FALSE,
            "attr" => array(
                "accept" => "image/*",
                "multiple" => "multiple",
            )))
            ->add('tags');
    }

    public function getName()
    {
        return 'blogger_gallerybundle_gallerytype';
    }
}
