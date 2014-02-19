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
        $oPostEntity->setDateCreate(new \DateTime());
        $oPostEntity->setDateEdit(new \DateTime());
        $oPostEntity->setDeleted(false);

        $this->_em->persist($oPostEntity);
        $this->_em->flush();

        return $oPostEntity;
    }
    
    /**
     * Update post entity into db
     * @param \Application\Entity\Post $oPostEntity
     * @return \Application\Entity\Post
     */
    public function updatePostEntity(\Application\Entity\Post $oPostEntity) {
        $oPostEntity->setDateEdit(new \DateTime());
        $this->_em->flush();

        return $oPostEntity;
    }
 
    /**
     * Delete post entity into db
     * @param \Application\Entity\Post $oPostEntity
     * @return \Application\Entity\Post
     */
    public function deletePostEntity(\Application\Entity\Post $oPostEntity) {
        $this->_em->remove($oPostEntity);
        $this->_em->flush();

        return $oPostEntity;
    }
}
