<?php

namespace Application\Repository;

class PostRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * Save post entity into db
     * @param \Application\Entity\Post $oPostEntity
     * @return \Application\Entity\Post
     */
    public function createPostEntity(\Application\Entity\Post $oPostEntity) {
        $this->_em->persist($oPostEntity);
        $this->_em->flush();

        return $oPostEntity;
    }

}
