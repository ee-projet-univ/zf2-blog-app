<?php

namespace Application\Service;

class PostService implements \Zend\ServiceManager\ServiceLocatorAwareInterface {

    use \Zend\ServiceManager\ServiceLocatorAwareTrait;

    /**
     * @param \Application\Entity\Post $oPostEntity
     * @return \Application\Service\PostService
     */
    public function createPost(\Application\Entity\Post $oPostEntity) {
        // TODO: fill post with
        $oPostEntity->setDateCreate(new \DateTime());
        $oPostEntity->setDateEdit(new \DateTime());
        $oPostEntity->setDeleted(false);
        //$oPostEntity->setTitle(/* TODO */);
        //$oPostEntity->setContent(/* TODO */);
        //$oPostEntity->setAuthorId(/* TODO */);
        $this->getServiceLocator()->get('PostRepository')->createPostEntity($oPostEntity);

        return $this;
    }

}
