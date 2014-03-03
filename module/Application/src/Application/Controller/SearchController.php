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

class SearchController extends AbstractActionController
{
    public function indexAction()
    {
        $tag = $this->getEvent()->getRouteMatch()->getParam('tag');
        $nb_pages = ceil($this->getServiceLocator()->get('PostService')->countPostsByTagName($tag) / 5);

        $page = intval($this->getEvent()->getRouteMatch()->getParam('page'));
        if($page == 0) ++$page;
        if($page > $nb_pages) $page = 1;

        $offset = ($page - 1) * 5;
        $post = $this->getServiceLocator()->get('PostService')->getFivePostsByTagName($offset, $tag);

        return new ViewModel(array('title' => 'Résultats de la recherche pour le tag '.$tag,
                'page' => $page,
                'nb_pages' => $nb_pages,
                'post' => $post,
                'tag' => $tag));
    }
}
