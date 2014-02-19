<?php

namespace Application\Factory;

class CommentRepositoryFactory implements \Zend\ServiceManager\FactoryInterface {

    /**
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
     * @return \Application\Repository\CommentRepository
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator) {
        return $oServiceLocator->get('Doctrine\ORM\EntityManager')->getRepository('Application\Entity\Comment');
    }

}
