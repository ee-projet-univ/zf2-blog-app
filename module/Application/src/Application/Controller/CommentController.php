<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CommentController extends AbstractActionController
{

    public function createAction() {
        //Initialize view model
        $oView = new ViewModel(array(
            'title' => 'Nouveau commentaire',
            'form' => $this->getServiceLocator()->get('CommentForm')->bind($oCommentEntity = new \Application\Entity\Comment()),
            'isValid' => false
        ));
        
        return $oView;
    }
    
    public function updateAction() {
        //Initialize view model
        $oView = new ViewModel(array(
            'title' => 'Édition du commentaire',
            'form' => $this->getServiceLocator()->get('CommentForm')->bind($oCommentEntity = new \Application\Entity\Comment()),
            'isValid' => false
        ));
        
        return $oView;
    }
    
    public function deleteAction() {
        //Initialize view model
        $oView = new ViewModel(array(
            'title' => 'Suppression du commentaire',
        ));
        
        return $oView;
    }

}
