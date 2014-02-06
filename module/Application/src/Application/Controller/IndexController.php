<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');  
        $nb_posts = $em->getRepository('Application\Entity\Post')->findAll();
        
        $nb_pages = ceil(count($nb_posts) / 5);

        $page = (isset($_GET['pid']) ? intval($_GET['page']) : 1);
        if($page == 0) ++$page;

        $offset = ($page - 1) * 5;
        $limit = 5;
        
        $dql = $em->createQuery('SELECT p '
                               .'FROM Application\Entity\Post p '
                               .'WHERE p.is_deleted = 0 '
                               .'ORDER BY p.date_create DESC ')
                   ->setFirstResult($offset)
                   ->setMaxResults($limit);
        
        $five_latest_post = $dql->getArrayResult();
        return new ViewModel(array('page' => $page,
                                   'nb_pages' => $nb_pages,
                                   'post' => $five_latest_post));
    }
}
