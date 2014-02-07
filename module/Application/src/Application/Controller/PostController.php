<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    public function viewAction()
    {
        
        //requete post
        $pid = intval($this->getEvent()->getRouteMatch()->getParam('pid'));

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default'); 
        $post = $em->find('Application\Entity\Post', (int)$pid);
        
        //requete commentaire
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');  
        $dql = $em->createQuery('SELECT c, u '
                       .'FROM Application\Entity\Comment c '
                       .'JOIN c.author u '
                       .'WHERE c.is_deleted = 0 '
                       .'AND c.post = ?1 '
                       .'ORDER BY c.date_create DESC ');
        $dql->setParameter(1, $pid);
        
        $nb_comment = $dql->getArrayResult();
        $nb_pages = ceil(count($nb_comment) / 10);

        $page = intval($this->getEvent()->getRouteMatch()->getParam('page'));
        if($page == 0) ++$page;
        if($page > $nb_pages) $page = 1;

        $offset = ($page - 1) * 10;
        $limit = 10;
        
        $dql ->setFirstResult($offset) ->setMaxResults($limit);
        $ten_comment = $dql->getArrayResult();

        return new ViewModel(array('title' => 'Consultation d’un billet',
                                   'post'  => $post,
                                   'comment' => $ten_comment));
    }
    
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