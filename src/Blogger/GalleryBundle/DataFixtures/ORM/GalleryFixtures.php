<?php
// src/Blogger/GalleryBundle/DataFixtures/ORM/GalleryFixtures.php

namespace Blogger\GalleryBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\GalleryBundle\Entity\Gallery;

class GalleryFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $gallery1 = new Gallery();
        $gallery1->setTitle('My First Gallery');
        $gallery1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
        $gallery1->setTags('stuffs, nshit');
        $gallery1->setCreated(new \DateTime());
        $gallery1->setUpdated($gallery1->getCreated());
        $manager->persist($gallery1);

        $manager->flush();
        $this->addReference('gallery-1', $gallery1);
    }

    public function getOrder()
    {
        return 1;
    }

}