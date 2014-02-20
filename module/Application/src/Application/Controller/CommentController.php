<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CommentController extends AbstractActionController
{
    public function createAction() {
        $pid = intval($this->getEvent()->getRouteMatch()->getParam('pid'));
        $post = $this->getServiceLocator()->get('PostService')->getPostEntityByPostId((int) $pid);

        if($post == null || $post->isDeleted())
        {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        else {
            // Initialize view model
            $oView = new ViewModel(array(
                'title' => 'Nouveau commentaire',
                'form' => $this->getServiceLocator()->get('CommentForm'),
                'isValid' => false
            ));

            if ($this->getRequest()->isPost()
                && $oView->form->setData($this->params()->fromPost())->isValid()
                //Create user through the user service
                && $this->getServiceLocator()->get('CommentService')->createComment($oView->form->getData(), $post))
            {
                $oView->isValid = true;
            }

            return $oView;
        }
    }
    
    public function updateAction() {
        $cid = intval($this->getEvent()->getRouteMatch()->getParam('cid'));
        $comm = $this->getServiceLocator()->get('CommentService')->getCommentEntityByCommentId((int) $cid);
        $userme = $this->getServiceLocator()->get('UserService')->getCurrentUserEntity();

        if($comm == null || $comm->isDeleted()
        || ($comm->getAuthor()->getId() != $userme->getId() && $userme->getRoles()[0]->getRoleId() != "administrator"))
        {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        else {
            $bind = array('content' => $comm->getContent(),
                'submit' => 'Éditer');

            // Initialize view model
            $oView = new ViewModel(array(
                'title' => 'Édition du commentaire',
                'form' => $this->getServiceLocator()->get('CommentForm')->setData($bind),
                'isValid' => false
            ));
            
            if ($this->getRequest()->isPost()
                && $oView->form->setData($this->params()->fromPost())->isValid()
                //Create user through the user service
                && $this->getServiceLocator()->get('CommentService')->updateComment($oView->form->getData(), $comm))
            {
                $oView->isValid = true;
            }

            return $oView;
        }
    }
    
    public function deleteAction() {
        $cid = intval($this->getEvent()->getRouteMatch()->getParam('cid'));
        $sur = intval($this->getEvent()->getRouteMatch()->getParam('sur'));
        $comm = $this->getServiceLocator()->get('CommentService')->getCommentEntityByCommentId((int) $cid);
        $userme = $this->getServiceLocator()->get('UserService')->getCurrentUserEntity();

        if($comm == null || $comm->isDeleted()
        || ($comm->getAuthor()->getId() != $userme->getId() && $userme->getRoles()[0]->getRoleId() != "administrator"))
        {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        else {
            // Initialize view model
            $oView = new ViewModel(array(
                'title' => 'Suppression d’un commentaire',
                'cid' => $cid,
                'comm' => $comm,
                'isValid' => false
            ));
            
            if($sur && $this->getServiceLocator()->get('CommentService')->deleteComment($comm))
            {
                $oView->isValid = true;
            }

            return $oView;
        }
    }

}
