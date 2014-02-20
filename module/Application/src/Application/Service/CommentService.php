<?php

namespace Application\Service;

class CommentService implements \Zend\ServiceManager\ServiceLocatorAwareInterface {

    use \Zend\ServiceManager\ServiceLocatorAwareTrait;

    /**
     * @param \Application\Entity\Post $oPostEntity
     * @return \Application\Service\CommentService
     */
    public function createComment(array $aData, \Application\Entity\Post $oPostEntity) {
        $oCommentEntity = new \Application\Entity\Comment();

        // Données du formulaire
        $oCommentEntity->setContent($aData['content']);
     
        // Données à récupérer
        $oCommentEntity->setPost($oPostEntity);
        $oCommentEntity->setAuthor($this->getServiceLocator()->get('UserService')->getCurrentUserEntity());

        // Création du commentaire
        $this->getServiceLocator()->get('CommentRepository')->createCommentEntity($oCommentEntity);
 
        return $this;
    }

    /**
     * @param \Application\Entity\Comment $oCommentEntity
     * @return \Application\Service\CommentService
     */
    public function updateComment(array $aData, \Application\Entity\Comment $oCommentEntity) {
        $oCommentEntity->setContent($aData['content']);
        $this->getServiceLocator()->get('CommentRepository')->updateCommentEntity($oCommentEntity);

        return $this;
    }
    
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
