<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    public function createAction()
    {
        //Define title
        $this->layout()->title = 'Nouveau billet';

        //Assign form
        $this->view->form = $this->getServiceLocator()->get('PostForm');
        if(
                $this->getRequest()->isPost()
                && $this->view->form->setData($this->params()->fromPost())->isValid()
                && ($aData = $this->view->form->getData())
                && $this->getServiceLocator()->get('PostService')->createPost($aData)
        )$this->view->isValid = true;
        return $this->view;
    }
}
