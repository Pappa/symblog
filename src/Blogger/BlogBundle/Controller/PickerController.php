<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Gallery;
use Blogger\BlogBundle\Entity\Image;
use Blogger\BlogBundle\Form\GalleryType;


class PickerController extends Controller
{
    /**
     * picker
     */
    public function pickerAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $galleries = $em->getRepository('BloggerBlogBundle:Gallery')->findAll();
        
        return $this->render('BloggerBlogBundle:Picker:picker.html.twig', array(
            'galleries'      => $galleries,
        ));
    }
}
