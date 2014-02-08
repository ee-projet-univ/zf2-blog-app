<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    public function viewAction()
    {
        // Requête sur le billet
        $pid = intval($this->getEvent()->getRouteMatch()->getParam('pid'));

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default'); 
        $post = $em->find('Application\Entity\Post', (int)$pid);
        
        // Requête sur les commentaires
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');  
        $dql = $em->createQuery('SELECT c, u '
                               .'FROM Application\Entity\Comment c '
                               .'JOIN c.author u '
                               .'WHERE c.is_deleted = 0 '
                               .'AND c.post = ?1 '
                               .'ORDER BY c.date_create DESC');
        $dql->setParameter(1, $pid);
        
        $nb_comment = $dql->getArrayResult();
        $nb_pages = ceil(count($nb_comment) / 10);

        $page = intval($this->getEvent()->getRouteMatch()->getParam('page'));
        if($page == 0) ++$page;
        if($page > $nb_pages) $page = 1;

        $offset = ($page - 1) * 10;
        $limit = 10;
        
        $dql->setFirstResult($offset)->setMaxResults($limit);
        $ten_comment = $dql->getArrayResult();

        return new ViewModel(array('title'   => 'Consultation d’un billet',
                                   'post'    => $post,
                                   'comment' => $ten_comment));
    }
    
    public function createAction()
    {
        $form = $this->getServiceLocator()->get('FormElementManager')->get('\Application\Form\PostForm');
        $isValid = false;

        if($this->getRequest()->isPost()) {
           $form->setData($this->params()->fromPost())->isValid();
           $aData = $form->getData();
           $this->getServiceLocator()->get('PostService')->createPost($aData);
           $isValid = true;
        }

        return new ViewModel(array('title'   => 'Nouveau billet',
                                   'form'    => $form,
                                   'isValid' => $isValid));
    }
}