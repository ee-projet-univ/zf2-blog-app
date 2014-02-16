<?php

namespace Application\Factory;

class PostRepositoryFactory implements \Zend\ServiceManager\FactoryInterface {

    /**
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
     * @return \Application\Service\PostService
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator) {
        return $oServiceLocator->get('Doctrine\ORM\EntityManager')->getRepository('Application\Entity\Post');
    }

}
