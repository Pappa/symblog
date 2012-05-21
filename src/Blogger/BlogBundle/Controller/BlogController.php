<?php
// src/Blogger/BlogBundle/Controller/BlogController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Blogger\BlogBundle\Entity\Blog;
use Blogger\BlogBundle\Form\BlogType;

/**
 * Blog controller.
 */
class BlogController extends Controller
{
    /**
     * new blog entry
     */
    public function newAction()
    {
        
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN'))
            throw new AccessDeniedException();

        $blog = new Blog();
        $blog->setAuthor($this->get('security.context')->getToken()->getUser()->getUsername());
        $form   = $this->createForm(new BlogType(), $blog);

        $request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
            
                $em = $this->getDoctrine()
                           ->getEntityManager();
                $em->persist($blog);
                $em->flush();
    
                return $this->redirect($this->generateUrl('BloggerBlogBundle_blog_show', array(
                    'id' => $blog->getId(),
                    'slug'  => $blog->getSlug()))
                );
            }
        }
        
        return $this->render('BloggerBlogBundle:Blog:new.html.twig', array(
            'blog'      => $blog,
            'form'      => $form->createView()
        ));
    }
    /**
     * Show a blog entry
     */
    public function showAction($id, $slug)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($id);

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
    
    public function editAction($id, $slug)
    {
        
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN'))
            throw new AccessDeniedException();
            
            
        $em = $this->getDoctrine()->getEntityManager();

        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($id);
        $form   = $this->createForm(new BlogType(), $blog);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        $request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
            
                $em = $this->getDoctrine()
                           ->getEntityManager();
                $em->persist($blog);
                $em->flush();
    
                return $this->redirect($this->generateUrl('BloggerBlogBundle_blog_show', array(
                    'id' => $blog->getId(),
                    'slug'  => $blog->getSlug()))
                );
            }
        }
        
        return $this->render('BloggerBlogBundle:Blog:edit.html.twig', array(
            'blog'      => $blog,
            'form'      => $form->createView()
        ));
    }
    
    public function deleteAction($id, $slug)
    {
        
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN'))
            throw new AccessDeniedException();
            
            
        $em = $this->getDoctrine()->getEntityManager();

        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($id);
/*
        if (!$em->remove($blog)) {
            throw $this->createNotFoundException('Unable to delete Blog post.');
        } else {
            $em->flush();
        }*/
            
            $em->remove($blog);
            $em->flush();
    
            return $this->redirect($this->generateUrl('BloggerBlogBundle_homepage'));
    }
}