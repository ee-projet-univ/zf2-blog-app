<?php

namespace Application\Service;

class PostService implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{

    use \Zend\ServiceManager\ServiceLocatorAwareTrait;

    /**
     * @param \Application\Entity\Post $oPostEntity
     * @return \Application\Service\PostService
     */
    public function createPost(\Application\Entity\Post $oPostEntity) {
        // TODO: fill post with
        $this->getServiceLocator()->get('\Application\Repository\PostRepository')->createPostEntity($oPostEntity);

        return $this;
    }

}
