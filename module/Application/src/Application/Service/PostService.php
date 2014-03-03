<?php

namespace Application\Service;

class PostService implements \Zend\ServiceManager\ServiceLocatorAwareInterface {

    use \Zend\ServiceManager\ServiceLocatorAwareTrait;

    /**
     * @param \Application\Entity\Post $oPostEntity
     * @return \Application\Service\PostService
     */
    public function createPost(array $aData) {
        /** Le billet **/
        $oPostEntity = new \Application\Entity\Post();

        // Données du formulaire
        $oPostEntity->setTitle($aData['title']);
        $oPostEntity->setContent($aData['content']);
     
        // Données à récupérer
        $oPostEntity->setAuthor($this->getServiceLocator()->get('UserService')->getCurrentUserEntity());

        // Création du billet
        $newPost = $this->getServiceLocator()->get('PostRepository')->createPostEntity($oPostEntity);
       
        /** Les tags **/
        $tags = explode(' ', $aData['tag']);
        foreach($tags as $t)
        {
            $oTagEntity = new \Application\Entity\Tag();
            $oTagEntity->setPost($newPost);
            $oTagEntity->setName($t);
            $this->getServiceLocator()->get('TagRepository')->createTagEntity($oTagEntity);
        }

        return $this;
    }
    
    /**
     * @param \Application\Entity\Post $oPostEntity
     * @return \Application\Service\PostService
     */
    public function updatePost(array $aData, \Application\Entity\Post $oPostEntity) {
        // Données du formulaire
        $oPostEntity->setTitle($aData['title']);
        $oPostEntity->setContent($aData['content']);

        // Mise à jour du billet
        $this->getServiceLocator()->get('PostRepository')->updatePostEntity($oPostEntity);
       
        /** Les tags **/
        // Suppression de ceux existants
        $tags = $this->getServiceLocator()->get('TagService')->getTagEntitiesByPostId((int) $oPostEntity->getId());
        foreach($tags as $t)
        {
            $this->getServiceLocator()->get('TagRepository')->deleteTagEntity($t);
        }

        // Re-création
        $tags = explode(' ', $aData['tag']);
        foreach($tags as $t)
        {
            $oTagEntity = new \Application\Entity\Tag();
            $oTagEntity->setPost($oPostEntity);
            $oTagEntity->setName($t);
            $this->getServiceLocator()->get('TagRepository')->createTagEntity($oTagEntity);
        }

        return $this;
    }
    
    /**
     * @param \Application\Entity\Post $oPostEntity
     * @return \Application\Service\PostService
     */
    public function deletePost(\Application\Entity\Post $oPostEntity) {
        // Suppression des tags
        $tags = $this->getServiceLocator()->get('TagService')->getTagEntitiesByPostId((int) $oPostEntity->getId());
        foreach($tags as $t)
        {
            $this->getServiceLocator()->get('TagRepository')->deleteTagEntity($t);
        }
      
        // Suppression des commentaires
        $comms = $this->getServiceLocator()->get('CommentService')->getCommentEntitiesByPostId((int) $oPostEntity->getId());
        foreach($comms as $c)
        {
            $this->getServiceLocator()->get('CommentRepository')->deleteCommentEntity($c);
        }

        // Suppression du billet
        $this->getServiceLocator()->get('PostRepository')->deletePostEntity($oPostEntity);
        
        return $this;
    }
    
    public function getPostEntityByPostId($iPostId) {
        return $this->getServiceLocator()->get('PostRepository')->find($iPostId);
    }

    public function getFivePosts($offset) {
        return $this->getServiceLocator()->get('PostRepository')->findBy(array('is_deleted' => 0), array('date_create' => 'DESC'), 5, $offset);
    }
    
    public function countPosts() {
        return count($this->getServiceLocator()->get('PostRepository')->findAll());
    }
}
