<?php

namespace Application\Service;

class UserService implements \Zend\ServiceManager\ServiceLocatorAwareInterface {

    use \Zend\ServiceManager\ServiceLocatorAwareTrait;
    
    public function getCurrentUserEntity() {
        $uid = $this->getServiceLocator()->get('zfcuser_auth_service')->getIdentity()->getId();
        return $this->getServiceLocator()->get('UserRepository')->find((int) $uid);
    }
}
