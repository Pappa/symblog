<?php
// src/Blogger/ShopBundle/DataFixtures/ORM/CommentFixtures.php

namespace Blogger\ShopBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\ShopBundle\Entity\Image;
use Blogger\ShopBundle\Entity\Product;

class ImageFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $image = new Image();
        $image->setPath('4f96bec04b1ac.jpg');
        $image->setProduct($manager->merge($this->getReference('product-1')));
        $manager->persist($image);
        
        $image = new Image();
        $image->setPath('4f96bec04b7ec.jpg');
        $image->setProduct($manager->merge($this->getReference('product-1')));
        $manager->persist($image);
        
        $image = new Image();
        $image->setPath('4f96bec04b7ec.jpg');
        $image->setProduct($manager->merge($this->getReference('product-2')));
        $manager->persist($image);
        
        $image = new Image();
        $image->setPath('4f96bec04b7ec.jpg');
        $image->setProduct($manager->merge($this->getReference('product-3')));
        $manager->persist($image);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}