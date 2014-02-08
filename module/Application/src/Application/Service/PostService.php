<?php
namespace Application\Service;

class PostService implements \Zend\ServiceManager\ServiceLocatorAwareInterface {
    use \Zend\ServiceManager\ServiceLocatorAwareTrait;

    /**
     * @param array $aRegisterData
     * @throws \InvalidArgumentException
     * @return 
     */
    public function createPost(array $aRegisterData) {
        // TODO: Fill in database with entities here
        $oPost = new \Application\Entity\Post();
        $this->getServiceLocator()->get('\Application\Repository\PostRepository')->create($oPost);

        return $this;
    }
}