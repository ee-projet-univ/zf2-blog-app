<?php

namespace Application\Repository;

class RatingRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * Save rating entity into db
     * @param \Application\Entity\Rating $oRatingEntity
     * @return \Application\Entity\Rating
     */
    public function createRatingEntity(\Application\Entity\Rating $oPostEntity) {
        $this->_em->persist($oRatingEntity);
        $this->_em->flush();

        return $oRatingEntity;
    }
    
    /**
     * Update rating entity into db
     * @param \Application\Entity\Rating $oRatingEntity
     * @return \Application\Entity\Rating
     */
    public function updateRatingEntity(\Application\Entity\Rating $oRatingEntity) {
        $this->_em->flush();

        return $oRatingEntity;
    }
 
    /**
     * Delete rating entity into db
     * @param \Application\Entity\Rating $oRatingEntity
     * @return \Application\Entity\Rating
     */
    public function deleteRatingEntity(\Application\Entity\Rating $oRatingEntity) {
        $this->_em->remove($oRatingEntity);
        $this->_em->flush();

        return $oRatingEntity;
    }
}
