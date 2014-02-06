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
        $nb_post = $em->getRepository('Application\Entity\Post')->findAll();
        
        $nb_page = ceil(count($nb_post) / 5);
        
        $offset = 0;
        $limit = 5;
        
        $dql = $em->createQuery('SELECT p '
                               .'FROM Application\Entity\Post p '
                               .'WHERE p.is_deleted = 0 '
                               .'ORDER BY p.date_create DESC ');
        
        $five_latest_post = $dql->getArrayResult();
        return new ViewModel(array('pagination' => $nb_page, 'post' => $five_latest_post));
    }
}
