<?php

namespace Application\Factory;

class CommentServiceFactory implements \Zend\ServiceManager\FactoryInterface
{

    /**
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     * @param  \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
     * @return \Application\Service\CommentService
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator) {
        return new \Application\Service\CommentService();
    }

}
