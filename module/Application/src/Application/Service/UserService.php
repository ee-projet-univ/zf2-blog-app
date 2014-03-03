<?php

namespace Application\Service;

class UserService implements \Zend\ServiceManager\ServiceLocatorAwareInterface {

    use \Zend\ServiceManager\ServiceLocatorAwareTrait;
    
    public function getCurrentUserEntity() {
        if($user = $this->getServiceLocator()->get('zfcuser_auth_service')->getIdentity()) {
            return $this->getServiceLocator()->get('UserRepository')->find((int) $user->getId());
        }
        return null;
    }
}
