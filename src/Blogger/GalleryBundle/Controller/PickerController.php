<?php

namespace Blogger\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\GalleryBundle\Entity\Gallery;
use Blogger\GalleryBundle\Entity\Image;
use Blogger\GalleryBundle\Form\GalleryType;


class PickerController extends Controller
{
    /**
     * picker
     */
    public function pickerAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $galleries = $em->getRepository('BloggerGalleryBundle:Gallery')->findAll();
        
        return $this->render('BloggerGalleryBundle:Picker:picker.html.twig', array(
            'galleries'      => $galleries,
        ));
    }
}
