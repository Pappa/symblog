<?php
// src/Blogger/BlogBundle/Controller/BlogController.php

namespace Blogger\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Blogger\BlogBundle\Entity\Blog;
use Blogger\BlogBundle\Form\BlogType;

use Blogger\BlogBundle\Controller\BlogController as BaseController;

/**
 * Blog controller.
 */
class BlogController extends BaseController
{
    /**
     * Show a blog entry
     */
    public function showAction($id, $slug)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($id);
        
        $find = array('/\[\[image="([0-9]+)"\]\]/i');
        
        $blog->setBlog(preg_replace_callback($find, Array($this,"imageTag"), nl2br($blog->getBlog())));
        
        $find = array('/\[\[gallery="([0-9]+)[^]]*\]\]/i');
        
        $blog->setBlog(preg_replace_callback($find, Array($this,"galleryInc"), $blog->getBlog()));
        
        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }
    
        $comments = $em->getRepository('BloggerBlogBundle:Comment')
                       ->getCommentsForBlog($blog->getId());
    
        return $this->render('BloggerBlogBundle:Blog:show.html.twig', array(
            'blog'      => $blog,
            'comments'  => $comments
        ));
    }
    
    /**
     * Callback function to get image path
     */
    public function imageTag($arrMatch) {
        
        $em = $this->getDoctrine()->getEntityManager();

        $image = $em->getRepository('BloggerGalleryBundle:Image')->find($arrMatch[1]);
        
        if (!$image) {
            throw $this->createNotFoundException('Unable to find image.');
        }
        
        return $this->renderView('BloggerGalleryBundle:Gallery:image.html.twig', array(
            'image'      => $image,
        ));
        
    }
    
    /**
     * Callback function to insert gallery
     */
    public function galleryInc($arrMatch) {
        
        $em = $this->getDoctrine()->getEntityManager();

        $gallery = $em->getRepository('BloggerGalleryBundle:Gallery')->find($arrMatch[1]);
        
        if (!$gallery) {
            throw $this->createNotFoundException('Unable to find gallery.');
        }
        
        return $this->renderView('BloggerGalleryBundle:Gallery:gallery.html.twig', array(
            'images'      => $gallery->getImages(),
        ));
        
    }
}