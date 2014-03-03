<?php

namespace Application\Service;

class RatingService implements \Zend\ServiceManager\ServiceLocatorAwareInterface {
    use \Zend\ServiceManager\ServiceLocatorAwareTrait;
    
    /**
     * @param \Application\Entity\Post $oPostEntity, int $rating
     * @return \Application\Service\PostService
     */
    public function rate(\Application\Entity\Post $oPostEntity, $rating) {
        exit;
        
        return $this;
    }
}
