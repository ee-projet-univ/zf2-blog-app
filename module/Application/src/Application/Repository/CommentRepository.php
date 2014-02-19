<?php

namespace Application\Repository;

class CommentRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * Save comment entity into db
     * @param \Application\Entity\Comment $oCommentEntity
     * @return \Application\Entity\Comment
     */
    public function createCommentEntity(\Application\Entity\Comment $oCommentEntity) {
        $oCommentEntity->setDateCreate(new \DateTime());
        $oCommentEntity->setDateEdit(new \DateTime());
        $oCommentEntity->setDeleted(false);

        $this->_em->persist($oCommentEntity);
        $this->_em->flush();

        return $oCommentEntity;
    }
    
    /**
     * Update comment entity into db
     * @param \Application\Entity\Comment $oCommentEntity
     * @return \Application\Entity\Comment
     */
    public function updateCommentEntity(\Application\Entity\Comment $oCommentEntity) {
        $oCommentEntity->setDateEdit(new \DateTime());
        $this->_em->flush();

        return $oCommentEntity;
    }
 
    /**
     * Delete comment entity into db
     * @param \Application\Entity\Comment $oCommentEntity
     * @return \Application\Entity\Comment
     */
    public function deleteCommentEntity(\Application\Entity\Comment $oCommentEntity) {
        $oCommentEntity->setDeleted(true);
        $this->_em->flush();

        return $oCommentEntity;
    }
}
