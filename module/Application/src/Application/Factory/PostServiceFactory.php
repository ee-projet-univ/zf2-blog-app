<?php
namespace Application\Factory;

class PostServiceFactory implements \Zend\ServiceManager\FactoryInterface {
    /**
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
     * @return \Application\Service\PostService
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator) {
        $oService = new \Application\Service\PostService('post');
        return $oService->createPost(array());
    }
}