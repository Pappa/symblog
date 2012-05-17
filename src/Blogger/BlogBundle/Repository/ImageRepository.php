<?php

namespace Blogger\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ImageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ImageRepository extends EntityRepository
{
    public function getImagesForGallery($galleryId)
    {
        $qb = $this->createQueryBuilder('i')
                   ->select('i')
                   ->where('i.gallery = :gallery_id')
                   ->addOrderBy('i.created')
                   ->setParameter('gallery_id', $galleryId);

        return $qb->getQuery()
                  ->getResult();
    }
}