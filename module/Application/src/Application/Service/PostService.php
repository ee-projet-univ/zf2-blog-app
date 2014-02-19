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

        // Données par défaut
        $oPostEntity->setDateCreate(new \DateTime());
        $oPostEntity->setDateEdit(new \DateTime());
        $oPostEntity->setDeleted(false);

        // Données du formulaire
        $oPostEntity->setTitle($aData['title']);
        $oPostEntity->setContent($aData['content']);
     
        // Données à récupérer
        $current_user = $this->getServiceLocator()->get('zfcuser_auth_service')->getIdentity()->getId();
        $oPostEntity->setAuthor($this->getServiceLocator()->get('UserRepository')->find((int) $current_user));

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
    
    public function getPostEntityByPostId($iPostId) {
        return $this->getServiceLocator()->get('PostRepository')->find($iPostId);
    }

}
