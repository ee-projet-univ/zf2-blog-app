<?php
namespace Application\Service;

class PostService {
    /**
     * @param array $aRegisterData
     * @throws \InvalidArgumentException
     * @return 
     */
    public function createPost(array $aRegisterData){
        // Create Post
        $oPost = new \Application\Entity\PostEntity();
        $this->getServiceLocator()->get('Application\Repository\PostRepository')->create(/* TODO: */
        );

        return $this;
    }
}
