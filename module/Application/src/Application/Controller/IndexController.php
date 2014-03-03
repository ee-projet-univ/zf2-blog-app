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
        $nb_pages = ceil($this->getServiceLocator()->get('PostService')->countPosts() / 5);

        $page = intval($this->getEvent()->getRouteMatch()->getParam('page'));
        if($page == 0) ++$page;
        if($page > $nb_pages) $page = 1;

        $offset = ($page - 1) * 5;
        $post = $this->getServiceLocator()->get('PostService')->getFivePosts($offset);

        return new ViewModel(array('title' => 'Bienvenue sur le <span class="zf-green">ZF2 Blog App</span>&nbsp;!',
                                   'page' => $page,
                                   'nb_pages' => $nb_pages,
                                   'post' => $post));
    }

    public function searchAction()
    {
        $tags = $this->getEvent()->getRouteMatch()->getParam('tag');
        $filteredPosts = $this->getServiceLocator()->get('TagService')->getPostArrayByTagNames($tags);
        $nb_pages = ceil($this->getServiceLocator()->get('PostService')->countPostsByPostArray($filteredPosts) / 5);

        $page = intval($this->getEvent()->getRouteMatch()->getParam('page'));
        if($page == 0) ++$page;
        if($page > $nb_pages) $page = 1;

        $offset = ($page - 1) * 5;
        $post = $this->getServiceLocator()->get('PostService')->getFivePostsByPostArray($offset, $filteredPosts);

        return new ViewModel(array('title' => 'Résultats de la recherche pour le(s) tag(s) '.$tags,
                'page' => $page,
                'nb_pages' => $nb_pages,
                'post' => $post,
                'tags' => $tags));
    }
}
