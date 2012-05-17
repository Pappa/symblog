<?php
// src/Blogger/GalleryBundle/Entity/Gallery.php

namespace Blogger\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Blogger\GalleryBundle\Repository\GalleryRepository")
 * @ORM\Table(name="gallery")
 * @ORM\HasLifecycleCallbacks()
 */
class Gallery
{
    /**
     * @ORM\Column(type="string")
     */
    protected $slug;
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="text")
     */
    protected $tags;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="gallery")
     */
    protected $images;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;
    
    
    public function __construct()
    {
        $this->images = new ArrayCollection();
        
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
    }

    /**
     * @ORM\preUpdate
     */
    public function setUpdatedValue()
    {
       $this->setUpdated(new \DateTime());
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        
        $this->setSlug($this->title);
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set gallery
     *
     * @param text $gallery
     */
    public function setGallery($gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * Get gallery
     *
     * @return text 
     */
    public function getGallery($length = null)
    {
        if (false === is_null($length) && $length > 0)
            return substr($this->gallery, 0, $length);
        else
            return $this->gallery;
    }

    /**
     * Set tags
     *
     * @param text $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Get tags
     *
     * @return text 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $this->slugify($slug);
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);
    
        // trim
        $text = trim($text, '-');
    
        // transliterate
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }
    
        // lowercase
        $text = strtolower($text);
    
        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);
    
        if (empty($text))
        {
            return 'n-a';
        }
    
        return $text;
    }
    

    /**
     * Add images
     *
     * @param Blogger\GalleryBundle\Entity\Image $images
     */
    public function addImage(\Blogger\GalleryBundle\Entity\Image $images)
    {
        $this->images[] = $images;
    }

    /**
     * Get images
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
    

    /**
     * set images
     *
     * @param  $images
     */
    public function setImages($images)
    {
        /*    
        //$em = $this->get('doctrine')->getEntityManager();
                           
        foreach($images as $image) {
            var_dump($image);
            $i = new Image();
            $i->setPath('/uploads/images/poo555.jpg');
            //$i->setFile($image->pathName);
            
            $em->persist($i);
        }
        
        $em->flush();
        
        */
    }
}