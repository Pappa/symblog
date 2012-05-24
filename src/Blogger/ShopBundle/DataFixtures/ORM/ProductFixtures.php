<?php
// src/Blogger/ShopBundle/DataFixtures/ORM/ProductFixtures.php

namespace Blogger\ShopBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\ShopBundle\Entity\Product;
use Blogger\ShopBundle\Entity\Category;

class ProductFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $product1 = new Product();
        $product1->setTitle('My First Product');
        $product1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
        $product1->setPrice('22.99');
        $product1->setTags('stuffs, nshit');
        $product1->setCategory($manager->merge($this->getReference('category-1')));
        $product1->setCreated(new \DateTime());
        $product1->setUpdated($product1->getCreated());
        $manager->persist($product1);

        $manager->flush();
        $this->addReference('product-1', $product1);
        
        $product2 = new Product();
        $product2->setTitle('My Second Product');
        $product2->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
        $product2->setPrice('11.99');
        $product2->setTags('stuffs, nshit');
        $product2->setCategory($manager->merge($this->getReference('category-2')));
        $product2->setCreated(new \DateTime());
        $product2->setUpdated($product2->getCreated());
        $manager->persist($product2);

        $manager->flush();
        $this->addReference('product-2', $product2);
        
        $product3 = new Product();
        $product3->setTitle('My Third Product');
        $product3->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
        $product3->setPrice('9.99');
        $product3->setTags('stuffs, nshit');
        $product3->setCategory($manager->merge($this->getReference('category-2')));
        $product3->setCreated(new \DateTime());
        $product3->setUpdated($product3->getCreated());
        $manager->persist($product3);

        $manager->flush();
        $this->addReference('product-3', $product3);
    }

    public function getOrder()
    {
        return 1;
    }

}