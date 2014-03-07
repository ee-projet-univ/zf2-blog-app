<?php

namespace Application\Service;

class TagService implements \Zend\ServiceManager\ServiceLocatorAwareInterface {

    use \Zend\ServiceManager\ServiceLocatorAwareTrait;
    
    public function getTagEntitiesByPostId($iPostId) {
        $oPostEntity = $this->getServiceLocator()->get('PostService')->getPostEntityByPostId($iPostId);
        return $this->getServiceLocator()->get('TagRepository')->findBy(array('post' => $oPostEntity));
    }
    
    public function getPostArrayByTagNames($tags) {
        $oTagEntity = $this->getServiceLocator()->get('TagRepository')->findBy(array('name' => explode(' ', $tags)));
        $t = array();
        for($i = 0; $i < count($oTagEntity); ++$i) {
            $t[$i] = $oTagEntity[$i]->getPost()->getId();
        }
        return $t;
    }

    public function getMostPopularTags() {
        return $this->getServiceLocator()->get('TagRepository')->createQueryBuilder('t')->select('COUNT(t.name) as compteur, t.name')->addOrderBy('t.name', 'ASC')->addGroupBy('t.name')->getQuery()->getResult();
    }
}
