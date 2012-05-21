<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Blogger\BlogBundle\Entity\Gallery;
use Blogger\BlogBundle\Entity\Image;
use Blogger\BlogBundle\Form\GalleryType;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class GalleryController extends Controller
{
    /**
     * new gallery
     */
    public function newAction()
    {
        
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN'))
            throw new AccessDeniedException();

        $gallery = new Gallery();
        $form   = $this->createForm(new GalleryType(), $gallery);
        
        $formView = $form->createView();
        $formView->getChild('images')->set('name', $formView->getChild('images')->get('name') . '[]');
        $formView->getChild('images')->set('full_name', $formView->getChild('images')->get('full_name') . '[]');

        $request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
            
                $em = $this->getDoctrine()
                           ->getEntityManager();
                
                $em->persist($gallery);
                
                $i = $request->files->get($form->getName());
                
                var_dump($i);
                
                foreach($i["images"] as $im) {
                    $image = new Image();
                    $image->setFile(new UploadedFile($im->getPathName(),$im->getClientOriginalName()));
                    $image->setGallery($gallery);
                    $em->persist($image);
                }
                
                $em->flush();
    
                /*return $this->render('BloggerBlogBundle:Gallery:show.html.twig', array(
                    'gallery'      => $gallery
                ));*/
    
                // use the above return for debugging
                return $this->redirect($this->generateUrl('BloggerBlogBundle_gallery_show', array(
                    'slug'      => $gallery->getSlug(),
                    'id'      => $gallery->getId()
                )));
        
            }
        }
        
        return $this->render('BloggerBlogBundle:Gallery:new.html.twig', array(
            'gallery'      => $gallery,
            'form'      => $formView
        ));
    }
    /**
     * Show a gallery
     */
    public function showAction($slug, $start = '0')
    {
        $em = $this->getDoctrine()->getEntityManager();

        $gallery = $em->getRepository('BloggerBlogBundle:Gallery')->findOneBySlug($slug);

        if (!$gallery) {
            throw $this->createNotFoundException('Unable to find gallery.');
        }
    
        $images = $em->getRepository('BloggerBlogBundle:Image')
                       ->getImagesForGallery($gallery->getId());
    
        return $this->render('BloggerBlogBundle:Gallery:show.html.twig', array(
            'gallery'      => $gallery,
            'images'       => $images,
            'start'       => $start
        ));
    }
    /**
     * Show all galleries
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $galleries = $em->getRepository('BloggerBlogBundle:Gallery')->findAll();
    
        return $this->render('BloggerBlogBundle:Gallery:index.html.twig', array(
            'galleries'      => $galleries,
        ));
    }
    /**
     * Show individual gallery template
     */
    public function galleryAction($images)
    {
        return $this->render('BloggerBlogBundle:Gallery:gallery.html.twig', array(
            'images'      => $images,
        ));
    }
    /**
     * Show individual image tag
     */
    public function imageAction($images)
    {
        return $this->render('BloggerBlogBundle:Gallery:image.html.twig', array(
            'image'      => $image,
        ));
    }
}
