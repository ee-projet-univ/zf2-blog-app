<?php

namespace Application\Factory;

class UserServiceFactory implements \Zend\ServiceManager\FactoryInterface
{

    /**
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     * @param  \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
     * @return \Application\Service\UserService
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator) {
        return new \Application\Service\UserService();
    }

}
