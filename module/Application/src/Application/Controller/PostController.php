<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    public function viewAction() {
        // Requête sur le billet
        $pid = intval($this->getEvent()->getRouteMatch()->getParam('pid'));
        $post = $this->getServiceLocator()->get('PostService')->getPostEntityByPostId($pid);

        $nb_comment = $this->getServiceLocator()->get('CommentService')->countCommentsByPostEntity($post);
        $nb_pages = ceil($nb_comment / 10);

        $page = intval($this->getEvent()->getRouteMatch()->getParam('page'));
        if($page == 0) ++$page;
        if($page > $nb_pages) $page = 1;

        $offset = ($page - 1) * 10;
        $comment = $this->getServiceLocator()->get('CommentService')->getTenCommentsByPostEntity($offset, $post);
        
        // Les tags
        $tags = $this->getServiceLocator()->get('TagService')->getTagEntitiesByPostId((int) $pid);
        $t = array();
        foreach($tags as $k => $v) $t[$k] = $v->getName();

        $oView = new ViewModel(array('page' => $page,
            'nb_pages' => $nb_pages,
            'nb_comment' => $nb_comment,
            'title' => 'Consultation d’un billet',
            'post' => $post,
            'tags' => $t,
            'comment' => $comment));
        
        // La notation, si connecté
        if($oUserMeEntity = $this->getServiceLocator()->get('UserService')->getCurrentUserEntity()) {
            $oView->userme = $oUserMeEntity;
            $oView->rating = $this->getServiceLocator()->get('RatingService')->getRatingEntityByPostAndUserEntities($post, $oUserMeEntity);
        }

        return $oView;
    }

    /**
     * Process create form action
     * @return \Zend\View\Model\ViewModel
     */
    public function createAction() {
        // Initialize view model
        $oView = new ViewModel(array(
            'title' => 'Nouveau billet',
            'form' => $this->getServiceLocator()->get('PostForm'),
            'isValid' => false
        ));

        if ($this->getRequest()->isPost()
            && $oView->form->setData($this->params()->fromPost())->isValid()
            //Create user through the user service
            && $this->getServiceLocator()->get('PostService')->createPost($oView->form->getData()))
        {
            $oView->isValid = true;
        }

        return $oView;
    }

    /**
     * Process update form action
     * @return \Zend\View\Model\ViewModel
     */
    public function updateAction() {
        $pid = intval($this->getEvent()->getRouteMatch()->getParam('pid'));
        $post = $this->getServiceLocator()->get('PostService')->getPostEntityByPostId((int) $pid);
        $userme = $this->getServiceLocator()->get('UserService')->getCurrentUserEntity();

        if($post == null || $post->isDeleted()
        || ($post->getAuthor()->getId() != $userme->getId() && $userme->getRoles()[0]->getRoleId() != "administrator"))
        {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        else {
            $tags = $this->getServiceLocator()->get('TagService')->getTagEntitiesByPostId((int) $pid);
            $t = array();
            foreach($tags as $k => $v) $t[$k] = $v->getName();

            $bind = array('title' => $post->getTitle(),
                'content' => $post->getContent(),
                'tag' => implode(" ", $t),
                'submit' => 'Éditer');

            // Initialize view model
            $oView = new ViewModel(array(
                'title' => 'Édition billet',
                'form' => $this->getServiceLocator()->get('PostForm')->setData($bind),
                'isValid' => false
            ));
            
            if ($this->getRequest()->isPost()
                && $oView->form->setData($this->params()->fromPost())->isValid()
                //Create user through the user service
                && $this->getServiceLocator()->get('PostService')->updatePost($oView->form->getData(), $post))
            {
                $oView->isValid = true;
            }

            return $oView;
        }
    }
    
    public function deleteAction() {
        $pid = intval($this->getEvent()->getRouteMatch()->getParam('pid'));
        $sur = intval($this->getEvent()->getRouteMatch()->getParam('sur'));
        $post = $this->getServiceLocator()->get('PostService')->getPostEntityByPostId((int) $pid);
        $userme = $this->getServiceLocator()->get('UserService')->getCurrentUserEntity();

        if($post == null || $post->isDeleted()
        || ($post->getAuthor()->getId() != $userme->getId() && $userme->getRoles()[0]->getRoleId() != "administrator"))
        {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        else {
            // Initialize view model
            $oView = new ViewModel(array(
                'title' => 'Suppression billet',
                'pid' => $pid,
                'isValid' => false
            ));
            
            if($sur && $this->getServiceLocator()->get('PostService')->deletePost($post))
            {
                $oView->isValid = true;
            }

            return $oView;
        }
    }

    public function rateAction() {
        $pid = intval($this->getEvent()->getRouteMatch()->getParam('pid'));
        $rating = intval($this->getEvent()->getRouteMatch()->getParam('rating'));
        $post = $this->getServiceLocator()->get('PostService')->getPostEntityByPostId((int) $pid);

        if($post == null || $post->isDeleted() || !$this->getServiceLocator()->get('RatingService')->rate($post, $rating))
        {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        else {
            // Initialize view model
            $oView = new ViewModel(array(
                'title' => 'Notation d’un billet',
                'pid' => $pid
            ));

            return $oView;
        }
    }
}
