<?php

namespace Blogger\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\ShopBundle\Entity\Category;
use Blogger\ShopBundle\Form\CategoryType;
use Blogger\ShopBundle\Entity\Product;
use Blogger\ShopBundle\Form\ProductType;


class ShopController extends Controller
{
    
    public function shopAction()
    {
        $em = $this->getDoctrine()
                   ->getEntityManager();
    
        $products = $em->getRepository('BloggerShopBundle:Product')
                             ->getLatestProducts();
        
        return $this->render('BloggerShopBundle:Shop:shop.html.twig', array(
            'products'    => $products
        ));
    }
    
    public function categoryAction($category_slug)
    {
        $em = $this->getDoctrine()
                   ->getEntityManager();
                   
        $category = $em->getRepository('BloggerShopBundle:Category')->findOneBySlug($category_slug);
        
        return $this->render('BloggerShopBundle:Shop:category.html.twig', array('category' => $category));
    }
    
    public function categoryAddAction()
    {
        $category = new Category();
        $form   = $this->createForm(new CategoryType(), $category);
        
        $request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
            
                $em = $this->getDoctrine()
                           ->getEntityManager();
                $em->persist($category);
                $em->flush();
    
                return $this->redirect($this->generateUrl('BloggerShopBundle_category', array(
                    'category_slug'  => $category->getSlug()))
                );
            }
        }
        
        return $this->render('BloggerShopBundle:Shop:categoryAdd.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function productAction($category_slug, $product_slug)
    {
        $em = $this->getDoctrine()
                   ->getEntityManager();
                   
        $category = $em->getRepository('BloggerShopBundle:Category')->findOneBySlug($category_slug);
        $product = $em->getRepository('BloggerShopBundle:Product')->findOneBySlug($product_slug);
        
        return $this->render('BloggerShopBundle:Shop:product.html.twig', array('category' => $category, 'product' => $product));
    }
    
    public function productAddAction($category_slug)
    {
        $product = new Product();
        $form   = $this->createForm(new ProductType(), $product);
        
        $request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
            
                $em = $this->getDoctrine()
                           ->getEntityManager();
                $category = $em->getRepository('BloggerShopBundle:Category')->findOneBySlug($category_slug);
                $product->setCategory($category);
                $em->persist($product);
                $em->flush();
    
                return $this->redirect($this->generateUrl('BloggerShopBundle_product', array(
                    'product_slug'   => $product->getSlug(),
                    'category_slug'  => $category_slug))
                );
            }
        }
        
        return $this->render('BloggerShopBundle:Shop:productAdd.html.twig', array(
            'form' => $form->createView(),
            'category_slug'  => $category_slug
        ));
    }
    
    public function navAction($category_slug = NULL)
    {
        $em = $this->getDoctrine()
                   ->getEntityManager();
                   
        $categories = $em->getRepository('BloggerShopBundle:Category')->findAll();
        
        $return_array = array('categories' => $categories);
        
        if($category_slug) {
            $return_array['selected_category'] = $em->getRepository('BloggerShopBundle:Category')->findOneBySlug($category_slug);
        } else {
            $return_array['selected_category'] = NULL;
        }


        return $this->render('BloggerShopBundle:Shop:nav.html.twig', $return_array);
    }
}
