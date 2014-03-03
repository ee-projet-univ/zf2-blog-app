<?php

namespace Application\Service;

class RatingService implements \Zend\ServiceManager\ServiceLocatorAwareInterface {
    use \Zend\ServiceManager\ServiceLocatorAwareTrait;
    
    /**
     * @param \Application\Entity\Post $oPostEntity, int $rating
     * @return \Application\Service\PostService
     */
    public function rate(\Application\Entity\Post $oPostEntity, $rating) {
        $oUserMeEntity = $this->getServiceLocator()->get('UserService')->getCurrentUserEntity();
        
        // Mise à jour ou suppression de note
        if($oRatingEntity = $this->getRatingEntityByPostAndUserEntities($oPostEntity, $oUserMeEntity)) {
            // Mise à jour
            if($rating != 0) {
                $oRatingEntity->setValue($rating);
                $this->getServiceLocator()->get('RatingRepository')->updateRatingEntity($oRatingEntity);
            }
            // Suppression
            else {
                $this->getServiceLocator()->get('RatingRepository')->deleteRatingEntity($oRatingEntity);
            }
        }
        // Création de note
        else {
            $oRatingEntity = new \Application\Entity\Rating();
            
            $oRatingEntity->setUser($oUserMeEntity);
            $oRatingEntity->setPost($oPostEntity);
            $oRatingEntity->setValue($rating);
            
            $this->getServiceLocator()->get('RatingRepository')->createRatingEntity($oRatingEntity);
        }
        
        return $this;
    }

    public function getRatingEntityByPostAndUserEntities(\Application\Entity\Post $oPostEntity, \Application\Entity\User $oUserEntity) {
        return $this->getServiceLocator()->get('RatingRepository')->findOneBy(array('post' => $oPostEntity,
                'user' => $oUserEntity));
    }

    public function getAverageRatingByPostEntity(\Application\Entity\Post $oPostEntity) {
        return $this->getServiceLocator()->get('RatingRepository')->createQueryBuilder('r')->select('AVG(r.value) as average')->where('r.post = :post')->setParameter('post', $oPostEntity)->getQuery()->getResult()[0]['average'];
    }
}
