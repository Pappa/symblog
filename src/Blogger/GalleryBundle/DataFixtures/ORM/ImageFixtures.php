<?php
// src/Blogger/GalleryBundle/DataFixtures/ORM/CommentFixtures.php

namespace Blogger\GalleryBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\GalleryBundle\Entity\Image;
use Blogger\GalleryBundle\Entity\Blog;

class ImageFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $image = new Image();
        $image->setPath('4f96bec04b1ac.jpg');
        $image->setGallery($manager->merge($this->getReference('gallery-1')));
        $manager->persist($image);
        
        $image = new Image();
        $image->setPath('4f96bec04b7ec.jpg');
        $image->setGallery($manager->merge($this->getReference('gallery-1')));
        $manager->persist($image);
        
        $image = new Image();
        $image->setPath('4f96bec04ba97.jpg');
        $image->setGallery($manager->merge($this->getReference('gallery-1')));
        $manager->persist($image);
        
        $image = new Image();
        $image->setPath('4f96bec04bca3.jpg');
        $image->setGallery($manager->merge($this->getReference('gallery-1')));
        $manager->persist($image);
        
        $image = new Image();
        $image->setPath('4f96bec04be8a.jpg');
        $image->setGallery($manager->merge($this->getReference('gallery-1')));
        $manager->persist($image);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}