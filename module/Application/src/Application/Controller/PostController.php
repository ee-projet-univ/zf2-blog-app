<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    public function viewAction() {
        // Requête sur le billet
        $pid = intval($this->getEvent()->getRouteMatch()->getParam('pid'));

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $post = $em->find('Application\Entity\Post', (int) $pid);

        // Requête sur les commentaires
        $dql = $em->createQuery('SELECT c, u '
                . 'FROM Application\Entity\Comment c '
                . 'JOIN c.author u '
                . 'WHERE c.is_deleted = 0 '
                . 'AND c.post = ?1 '
                . 'ORDER BY c.date_create ASC');
        $dql->setParameter(1, $pid);

        $nb_comment = count($dql->getArrayResult());
        $nb_pages = ceil($nb_comment / 10);

        $page = intval($this->getEvent()->getRouteMatch()->getParam('page'));
        if ($page == 0)
            ++$page;
        if ($page > $nb_pages)
            $page = 1;

        $offset = ($page - 1) * 10;
        $limit = 10;

        $dql->setFirstResult($offset)->setMaxResults($limit);
        $ten_comment = $dql->getArrayResult();

        return new ViewModel(array('page' => $page,
            'nb_pages' => $nb_pages,
            'nb_comment' => $nb_comment,
            'title' => 'Consultation d’un billet',
            'post' => $post,
            'comment' => $ten_comment));
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
        // TODO: Vérifier admin ou possesseur ET is_deleted = false
        $pid = intval($this->getEvent()->getRouteMatch()->getParam('pid'));
        $post = $this->getServiceLocator()->get('PostService')->getPostEntityByPostId((int) $pid);
        $tags = $this->getServiceLocator()->get('TagService')->getTagEntitiesByPostId((int) $pid);
        $t = array();
        foreach($tags as $k => $v) $t[$k] = $v->getName();

        if($post == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        else {
            // Initialize view model
            $bind = array('title' => $post->getTitle(),
                'content' => $post->getContent(),
                'tag' => implode(" ", $t),
                'submit' => 'Éditer');

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
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $pid = intval($this->getEvent()->getRouteMatch()->getParam('pid'));
        $post = $em->find('Application\Entity\Post', (int) $pid);

        if($post == null) $this->getResponse()->setStatusCode(404);

        $oView = new ViewModel(array(
            'title' => 'Suppression billet',
        ));

        return $oView;
    }

}
