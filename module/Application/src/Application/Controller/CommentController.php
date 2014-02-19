<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CommentController extends AbstractActionController
{
    public function createAction() {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $pid = intval($this->getEvent()->getRouteMatch()->getParam('pid'));
        $post = $em->find('Application\Entity\Post', (int) $pid);

        if($post == null) $this->getResponse()->setStatusCode(404);

        // Initialize view model
        $oView = new ViewModel(array(
            'title' => 'Nouveau commentaire',
            'form' => $this->getServiceLocator()->get('CommentForm')->bind($oCommentEntity = new \Application\Entity\Comment()),
            'isValid' => false
        ));
        
        return $oView;
    }
    
    public function updateAction() {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $cid = intval($this->getEvent()->getRouteMatch()->getParam('cid'));
        $comm = $em->find('Application\Entity\Comment', (int) $cid);

        if($comm == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        else {
            // Initialize view model
            $oView = new ViewModel(array(
                'title' => 'Édition du commentaire',
                'form' => $this->getServiceLocator()->get('CommentForm')->bind($comm),
                'isValid' => false
            ));

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
