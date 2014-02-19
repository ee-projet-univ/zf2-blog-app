<?php

namespace Application\Service;

class CommentService implements \Zend\ServiceManager\ServiceLocatorAwareInterface {

    use \Zend\ServiceManager\ServiceLocatorAwareTrait;

    /**
     * @param \Application\Entity\Comment $oCommentEntity
     * @return \Application\Service\CommentService
     */
    public function deleteComment(\Application\Entity\Comment $oCommentEntity) {
        $this->getServiceLocator()->get('CommentRepository')->deleteCommentEntity($oCommentEntity);
        
        return $this;
    }
    
    public function getCommentEntitiesByPostId($iPostId) {
        $oPostEntity = $this->getServiceLocator()->get('PostService')->getPostEntityByPostId($iPostId);
        return $this->getServiceLocator()->get('CommentRepository')->findBy(array('post' => $oPostEntity));
    }

    public function getCommentEntityByCommentId($iCommentId) {
        return $this->getServiceLocator()->get('CommentRepository')->find($iCommentId);
    }
}
