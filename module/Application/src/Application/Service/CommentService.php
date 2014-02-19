<?php

namespace Application\Service;

class CommentService implements \Zend\ServiceManager\ServiceLocatorAwareInterface {

    use \Zend\ServiceManager\ServiceLocatorAwareTrait;
    
    public function getCommentEntitiesByPostId($iPostId) {
        $oPostEntity = $this->getServiceLocator()->get('PostService')->getPostEntityByPostId($iPostId);
        return $this->getServiceLocator()->get('CommentRepository')->findBy(array('post' => $oPostEntity));
    }
}
