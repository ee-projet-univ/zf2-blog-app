<?php

namespace Application\Factory;

class UserRepositoryFactory implements \Zend\ServiceManager\FactoryInterface {

    /**
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
     * @return \Application\Repository\UserRepository
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator) {
        return $oServiceLocator->get('Doctrine\ORM\EntityManager')->getRepository('Application\Entity\User');
    }

}
