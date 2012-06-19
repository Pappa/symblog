<?php

namespace Blogger\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Blogger\GalleryBundle\Entity\Gallery;
use Blogger\GalleryBundle\Entity\Image;
use Blogger\GalleryBundle\Form\GalleryType;
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
                
                foreach($i["images"] as $im) {
                    if(!$im->isValid()) {
                        
                        $mb = round(UploadedFile::getMaxFilesize()/1024/1024, 2);
                
                        return $this->render('BloggerGalleryBundle:Gallery:error.html.twig', array(
                            'mb'      => $mb,
                            'error'   => $im->getError()
                        ));
                    }
                    $image = new Image();
                    $image->setFile(new UploadedFile($im->getPathName(),$im->getClientOriginalName()));
                    $image->setGallery($gallery);
                    $em->persist($image);
                }
                
                $em->flush();
                
                return $this->redirect($this->generateUrl('BloggerGalleryBundle_gallery_show', array(
                    'slug'      => $gallery->getSlug(),
                    'id'      => $gallery->getId()
                )));
        
            }
        }
        
        return $this->render('BloggerGalleryBundle:Gallery:new.html.twig', array(
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

        $gallery = $em->getRepository('BloggerGalleryBundle:Gallery')->findOneBySlug($slug);
    
        $images = $em->getRepository('BloggerGalleryBundle:Image')
                       ->getImagesForGallery($gallery->getId());
    
        return $this->render('BloggerGalleryBundle:Gallery:show.html.twig', array(
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

        $galleries = $em->getRepository('BloggerGalleryBundle:Gallery')->findAll();
    
        return $this->render('BloggerGalleryBundle:Gallery:index.html.twig', array(
            'galleries'      => $galleries,
        ));
    }
    /**
     * Show individual gallery template
     */
    public function galleryAction($images)
    {
        return $this->render('BloggerGalleryBundle:Gallery:gallery.html.twig', array(
            'images'      => $images,
        ));
    }
    /**
     * Show individual image tag
     */
    public function imageAction($images)
    {
        return $this->render('BloggerGalleryBundle:Gallery:image.html.twig', array(
            'image'      => $image,
        ));
    }
    /**
     * Edit a gallery
     */
    public function editAction($id)
    {
        
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN'))
            throw new AccessDeniedException();
            
            
        $em = $this->getDoctrine()->getEntityManager();

        $gallery = $em->getRepository('BloggerGalleryBundle:Gallery')->find($id);
    
        $images = $em->getRepository('BloggerGalleryBundle:Image')
                       ->getImagesForGallery($gallery->getId());
    
        return $this->render('BloggerGalleryBundle:Gallery:edit.html.twig', array(
            'gallery'      => $gallery,
            'images'       => $images,
            'start'        => '0'
        ));
    }
    
    public function deleteAction($id)
    {
        
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN'))
            throw new AccessDeniedException();
            
            
        $em = $this->getDoctrine()->getEntityManager();

        $gallery = $em->getRepository('BloggerGalleryBundle:Gallery')->find($id);

        $em->remove($gallery);            
        $em->flush();
    
        return $this->redirect($this->generateUrl('BloggerGalleryBundle_gallery_index'));
    }
}
